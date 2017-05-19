<?php namespace WebEd\Plugins\Features\Http\DataTables;

use WebEd\Base\Http\DataTables\AbstractDataTables;
use Yajra\Datatables\Engines\CollectionEngine;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Engines\QueryBuilderEngine;
use WebEd\Plugins\Features\Models\Amenities;

class AmenitiesListDataTable extends AbstractDataTables
{
    protected $model;

    public function __construct()
    {
        $this->model = Amenities::select(['id', 'name', 'description', 'types']);
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
            'types' => [
                'title' => trans('webed-core::datatables.heading.type'),
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
            ['data' => 'name', 'name' => 'name', 'searchable' => true, 'orderable' => true],
            ['data' => 'description', 'name' => 'description'],
            ['data' => 'types', 'name' => 'types'],
            ['data' => 'actions', 'name' => 'actions', 'searchable' => false, 'orderable' => false],
        ];
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->setAjaxUrl(route('amenities.index.post'), 'POST');

        $this
            ->addFilter(1, form()->text('id', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => '...'
            ]))
            ->addFilter(2, form()->text('name', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => trans('webed-core::datatables.search') . '...',
            ]))
            ->addFilter(4, form()->text('type', '', [
                'class' => 'form-control form-filter input-sm',
                'placeholder' => trans('webed-core::datatables.heading.type') . '...',
            ]));

        $this->withGroupActions([
            '' => trans('webed-core::datatables.select') . '...',
            'deleted' => trans('webed-core::datatables.delete_these_items')
        ]);

        return $this->view();
    }

    /**
     * @return CollectionEngine|EloquentEngine|QueryBuilderEngine|mixed
     */
    protected function fetchDataForAjax()
    {
        return datatable()->of($this->model)
            ->rawColumns(['actions', 'types'])
            ->editColumn('id', function ($item) {
                return form()->customCheckbox([['id[]', $item->id]]);
            })
            ->addColumn('viewID', function ($item) {
                return $item->id;
            })
            ->addColumn('types', function ($item) {
                return trans('features::base.amenities_type.'.$item->types);
            })
            ->addColumn('actions', function ($item) {
                /*Edit link*/
                $deleteLink = route('amenities.delete.delete', ['id' => $item->id]);

                /*Buttons*/
                $editBtn = link_to(route('amenities.edit.get', ['id' => $item->id]), trans('webed-core::datatables.edit'), ['class' => 'btn btn-sm btn-outline green']);
            
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
