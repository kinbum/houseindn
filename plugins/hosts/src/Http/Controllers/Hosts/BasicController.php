<?php namespace WebEd\Plugins\Hosts\Http\Controllers\Hosts;

use Illuminate\Http\Request;
use WebEd\Base\Http\Controllers\BaseAdminController;
use WebEd\Base\Http\DataTables\AbstractDataTables;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use Yajra\Datatables\Engines\BaseEngine;

class BasicController extends BaseAdminController
{
    protected $module = 'hosts';

    /**
     * @var YourModuleRepositoryContract|EloquentBaseRepository
     */
    protected $repository;

    /**
     * @param EloquentBaseRepository $repository
     */
    public function __construct(YourModuleRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->middleware(function (Request $request, $next) {
            $this->getDashboardMenu($this->module);

            $this->breadcrumbs->addLink(trans('hosts::base.page_title'), route('admin::your-module.index.get'));

            return $next($request);
        });
    }

    /**
     * @param AbstractDataTables|BaseEngine $dataTables
     * @return @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(YourDataTables $dataTables)
    {
        $this->setPageTitle(trans('hosts::base.page_title'));

        $this->dis['dataTable'] = $dataTables->run();

        return do_filter(BASE_FILTER_CONTROLLER, $this, 'hosts', 'index.get', $dataTables)->viewAdmin('index');
    }

    /**
     * @param AbstractDataTables|BaseEngine $dataTables
     * @return mixed
     */
    public function postListing(YourDataTables $dataTables)
    {
        $data = $dataTables->with($this->groupAction());

        return do_filter(BASE_FILTER_CONTROLLER, $data, 'hosts', 'index.post', $this);
    }

    /**
     * Handle group actions
     * @return array
     */
    protected function groupAction()
    {
        $data = [];
        if ($this->request->get('customActionType', null) === 'group_action') {
            if (!$this->userRepository->hasPermission($this->loggedInUser, ['your-permission'])) {
                return [
                    'customActionMessage' => trans('webed-acl::base.do_not_have_permission'),
                    'customActionStatus' => 'danger',
                ];
            }

            $ids = (array)$this->request->get('id', []);
            $actionValue = $this->request->get('customActionValue');

            switch ($actionValue) {
                case 'deleted':
                    if (!$this->userRepository->hasPermission($this->loggedInUser, ['your-permission'])) {
                        return [
                            'customActionMessage' => trans('webed-acl::base.do_not_have_permission'),
                            'customActionStatus' => 'danger',
                        ];
                    }
                    /**
                     * Delete items
                     */
                     $ids = do_filter(BASE_FILTER_BEFORE_DELETE, $ids, 'hosts');

                     $result = $this->repository->delete($ids);

                     do_action(BASE_ACTION_AFTER_DELETE, 'hosts', $ids, $result);
                    break;
                case 'activated':
                case 'disabled':
                    $result = $this->repository->updateMultiple($ids, [
                        'status' => $actionValue,
                    ]);
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
     * Update status
     * @param $id
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateStatus($id, $status)
    {
        $data = [
            'status' => $status
        ];
        $result = $this->repository->update($id, $data);
        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');
        $code = $result ? \Constants::SUCCESS_NO_CONTENT_CODE : \Constants::ERROR_CODE;
        return response()->json(response_with_messages($msg, !$result, $code), $code);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        do_action(BASE_ACTION_BEFORE_CREATE, 'hosts', 'create.get');

        $this->assets
            ->addJavascripts([
                'jquery-ckeditor'
            ]);

        $this->setPageTitle(trans('hosts::base.page_title'));
        $this->breadcrumbs->addLink(trans('hosts::base.page_title'));

        return do_filter(BASE_FILTER_CONTROLLER, $this, 'hosts', 'create.get')->viewAdmin('create');
    }

    public function postCreate(YourCreateFormRequest $request)
    {
        do_action(BASE_ACTION_BEFORE_CREATE, 'hosts', 'create.post');

        $data = $request->all();
        $data['created_by'] = $this->loggedInUser->id;

        $result = $this->repository->create($data);

        do_action(BASE_ACTION_AFTER_CREATE, 'hosts', $result);

        $msgType = !$result ? 'danger' : 'success';
        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');

        flash_messages()
            ->addMessages($msg, $msgType)
            ->showMessagesOnSession();

        if (!$result) {
            return redirect()->back()->withInput();
        }

        if ($this->request->has('_continue_edit')) {
            return redirect()->to(route('admin::your-module.edit.get', ['id' => $result]));
        }

        return redirect()->to(route('admin::your-module.index.get'));
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

        $item = do_filter(BASE_FILTER_BEFORE_UPDATE, $item, 'hosts', 'edit.get');

        $this->assets
            ->addJavascripts([
                'jquery-ckeditor'
            ]);

        $this->setPageTitle(trans('hosts::base.edit_item') . ' #' . $item->id);
        $this->breadcrumbs->addLink(trans('hosts::base.edit_item'));

        $this->dis['object'] = $item;

        return do_filter(BASE_FILTER_CONTROLLER, $this, 'hosts', 'edit.get', $id)->viewAdmin('edit');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(YourUpdateFormRequest $request, $id)
    {
        $item = $this->repository->find($id);

        if (!$item) {
            flash_messages()
                ->addMessages(trans('webed-core::base.item_not_exists'), 'danger')
                ->showMessagesOnSession();

            return redirect()->back();
        }

        $item = do_filter(BASE_FILTER_BEFORE_UPDATE, $item, 'hosts', 'edit.post');

        $data = $request->all();
        $data['updated_by'] = $this->loggedInUser->id;

        $result = $this->repository->update($item, $data);

        do_action(BASE_ACTION_AFTER_UPDATE, 'hosts', $id, $result);

        $msgType = !$result ? 'danger' : 'success';
        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');

        flash_messages()
            ->addMessages($msg, $msgType)
            ->showMessagesOnSession();

        if ($this->request->has('_continue_edit')) {
            return redirect()->back();
        }

        return redirect()->to(route('admin::your-module.index.get'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDelete($id)
    {
        $id = do_filter(BASE_FILTER_BEFORE_DELETE, $id, 'hosts');

        $result = $this->repository->delete($id);

        do_action(BASE_ACTION_AFTER_DELETE, 'hosts', $id, $result);

        $msg = $result ? trans('webed-core::base.form.request_completed') : trans('webed-core::base.form.error_occurred');
        $code = $result ? \Constants::SUCCESS_NO_CONTENT_CODE : \Constants::ERROR_CODE;
        return response()->json(response_with_messages($msg, !$result, $code), $code);
    }
}
