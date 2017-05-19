<?php namespace WebEd\Plugins\Features\Http\Controllers;

use Illuminate\Http\Request;
use WebEd\Base\Http\Controllers\BaseAdminController;
use WebEd\Plugins\Features\Repositories\Contracts\AssetRepositoryContract;
use WebEd\Plugins\Features\Http\DataTables\AssetListDataTable;

use WebEd\Plugins\Features\Http\Requests\CreateAssetRequest;
use WebEd\Plugins\Features\Http\Requests\UpdateAssetRequest;

class AssetController extends BaseAdminController
{
    protected $module = 'features';

    /**
     * @var AssetRepositoryContract|EloquentBaseRepository
     */
    protected $repository;

    /**
     * @param EloquentBaseRepository $repository
     */
    public function __construct(AssetRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->middleware(function (Request $request, $next) {
            $this->getDashboardMenu($this->module .'-assets');

            $this->breadcrumbs->addLink(trans('features::base.features'), route('assets.index.get'));

            return $next($request); 
        });
    }

    /**
     * @param AbstractDataTables|BaseEngine $dataTables
     * @return @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(AssetListDataTable $dataTables)
    {
        $this->setPageTitle(trans('features::base.features'));

        $this->dis['dataTable'] = $dataTables->run();

        return do_filter(BASE_FILTER_CONTROLLER, $this, 'features', 'index.get', $dataTables)->viewAdmin('assets.index');
    }

    /**
     * @param AbstractDataTables|BaseEngine $dataTables
     * @return mixed
     */
    public function postListing(AssetListDataTable $dataTables)
    {
        $data = $dataTables->with($this->groupAction());

        return do_filter(BASE_FILTER_CONTROLLER, $data, 'features', 'index.post', $this);
    }

    /**
     * Handle group actions
     * @return array
     */
    protected function groupAction()
    {
        $data = [];
        if ($this->request->get('customActionType', null) === 'group_action') {
            if (!$this->userRepository->hasPermission($this->loggedInUser, ['update-assets'])) {
                return [
                    'customActionMessage' => trans('webed-acl::base.do_not_have_permission'),
                    'customActionStatus' => 'danger',
                ];
            }

            $ids = (array)$this->request->get('id', []);
            $actionValue = $this->request->get('customActionValue');

            switch ($actionValue) {
                case 'deleted':
                    if (!$this->userRepository->hasPermission($this->loggedInUser, ['delete-assets'])) {
                        return [
                            'customActionMessage' => trans('webed-acl::base.do_not_have_permission'),
                            'customActionStatus' => 'danger',
                        ];
                    }
                    /**
                     * Delete items
                     */
                     $ids = do_filter(BASE_FILTER_BEFORE_DELETE, $ids, 'features');

                     $result = $this->repository->delete($ids);

                     do_action(BASE_ACTION_AFTER_DELETE, 'features', $ids, $result);
                    break;
              
                default:
                    return [
                        'customActionMessage' => trans('webed-core::errors.' . \Constants::METHOD_NOT_ALLOWED . '.message'),
                        'customActionStatus' => 'danger'
                    ];
                    break;
            }
            $data['customActionMessage'] = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');
            $data['customActionStatus'] = !$result ? 'danger' : 'success';

        }
        return $data;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        do_action(BASE_ACTION_BEFORE_CREATE, 'features', 'create.get');

        $this->setPageTitle(trans('features::base.features'));
        $this->breadcrumbs->addLink(trans('features::base.assets'));

        return do_filter(BASE_FILTER_CONTROLLER, $this, 'features', 'create.get')->viewAdmin('assets.create');
    }

    public function postCreate(CreateAssetRequest $request)
    {
        do_action(BASE_ACTION_BEFORE_CREATE, 'features', 'create.post');

        $data = $this->parseData($request);
        $data['created_by'] = $this->loggedInUser->id;

        $result = $this->repository->createAsset($data);

        do_action(BASE_ACTION_AFTER_CREATE, 'features', $result);

        $msgType = !$result ? 'danger' : 'success';
        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');

        flash_messages()
            ->addMessages($msg, $msgType)
            ->showMessagesOnSession();

        if (!$result) {
            return redirect()->back()->withInput();
        }

        if ($this->request->has('_continue_edit')) {
            return redirect()->to(route('assets.edit.get', ['id' => $result]));
        }

        return redirect()->to(route('assets.index.get'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $item = $this->repository->find($id);

        if (!$item) {
            flash_messages()
                ->addMessages(trans('webed-core::base.item_not_exists'), 'danger')
                ->showMessagesOnSession();

            return redirect()->back();
        }

        $item = do_filter(BASE_FILTER_BEFORE_UPDATE, $item, 'features', 'edit.get');

        $this->setPageTitle(trans('features::base.form.edit_assets') . ' #' . $item->id);
        $this->breadcrumbs->addLink(trans('features::base.form.edit_assets'));

        $this->dis['object'] = $item;

        return do_filter(BASE_FILTER_CONTROLLER, $this, 'features', 'edit.get', $id)->viewAdmin('assets.edit');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(UpdateAssetRequest $request, $id)
    {
        $item = $this->repository->find($id);

        if (!$item) {
            flash_messages()
                ->addMessages(trans('webed-core::base.item_not_exists'), 'danger')
                ->showMessagesOnSession();

            return redirect()->back();
        }

        $item = do_filter(BASE_FILTER_BEFORE_UPDATE, $item, 'features', 'edit.post');

        $data = $this->parseData($request);
        $data['updated_by'] = $this->loggedInUser->id;

        $result = $this->repository->updateAsset($item, $data);

        do_action(BASE_ACTION_AFTER_UPDATE, 'features', $id, $result);

        $msgType = !$result ? 'danger' : 'success';
        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');

        flash_messages()
            ->addMessages($msg, $msgType)
            ->showMessagesOnSession();

        if ($this->request->has('_continue_edit')) {
            return redirect()->back();
        }

        return redirect()->to(route('assets.index.get'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDelete($id)
    {
        $id = do_filter(BASE_FILTER_BEFORE_DELETE, $id, 'features');

        $result = $this->repository->delete($id);

        do_action(BASE_ACTION_AFTER_DELETE, 'features', $id, $result);

        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');
        $code = $result ? \Constants::SUCCESS_NO_CONTENT_CODE : \Constants::ERROR_CODE;
        return response()->json(response_with_messages($msg, !$result, $code), $code);
    }

    protected function parseData(Request $request) {
        $data = $request->get('assets', []);
        
        if(!$data['slug'])
            $data['slug'] = str_slug($data['name']);
        
        return $data;
    } 
}
