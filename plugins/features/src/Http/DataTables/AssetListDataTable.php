<?php namespace WebEd\Plugins\Features\Http\DataTables;

use WebEd\Base\Http\DataTables\AbstractDataTables;
use Yajra\Datatables\Engines\CollectionEngine;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Engines\QueryBuilderEngine;

use WebEd\Plugins\Features\Models\Asset;

class AssetListDataTable extends AbstractDataTables
{
    protected $model;

    public function __construct()
    {
        $this->model = Asset::select(['id', 'name', 'description']);
    }

    public function headings()
    {
        return [
            'id' => [
                'title' => 'ID',
                'width' => '5%',
            ],
            'title' => [
                'title' => trans('webed-core::datatables.heading.title'),
                'width' => '20%',
            ],
            'description' => [
                'title' => trans('webed-core::datatables.heading.description'),
                'width' => '20%',
            ],
            'actions' => [
                'title' => trans('webed-core::datatables.heading.actions'),
                'width' => '30%',
            ],
        ];
    }

    public function columns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'searchable' => false, 'orderable' => false],
            ['data' => 'viewID', 'name' => 'id'],
            ['data' => 'name', 'name' => 'name'],
            ['data' => 'description', 'name' => 'description'],
            ['data' => 'actions', 'name' => 'actions', 'searchable' => false, 'orderable' => false],
        ];
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->setAjaxUrl(route('assets.index.post'), 'POST');

        $this
            ->addFilter(2, form()->text('name', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => trans('webed-core::datatables.search') . '...',
            ]));

        $this->withGroupActions([
            '' => trans('webed-core::datatables.select') . '...',
            'disabled' => trans('webed-core::datatables.disable_these_items'),
        ]);

        return $this->view();
    }

    /**
     * @return CollectionEngine|EloquentEngine|QueryBuilderEngine|mixed
     */
    protected function fetchDataForAjax()
    {
        return datatable()->of($this->model)
            ->rawColumns(['actions'])
            ->editColumn('id', function ($item) {
                return form()->customCheckbox([['id[]', $item->id]]);
            })
            ->addColumn('viewID', function ($item) {
                return $item->id;
            })
            ->editColumn('status', function ($item) {
                return html()->label(trans('webed-core::base.status.' . $item->status), $item->status);
            })
            ->addColumn('actions', function ($item) {
                /*Edit link*/
                $deleteLink = route('assets.delete.delete', ['id' => $item->id]);

                /*Buttons*/
                $editBtn = link_to(route('assets.edit.get', ['id' => $item->id]), trans('webed-core::datatables.edit'), ['class' => 'btn btn-sm btn-outline green']);
                
                $deleteBtn = form()->button(trans('webed-core::datatables.delete'), [
                    'title' => trans('webed-core::datatables.delete_this_item'),
                    'data-ajax' => $deleteLink,
                    'data-method' => 'DELETE',
                    'data-toggle' => 'confirmation',
                    'class' => 'btn btn-outline red-sunglo btn-sm ajax-link',
                    'type' => 'button',
                ]);

                return $editBtn . $deleteBtn;
            });
    }
}
