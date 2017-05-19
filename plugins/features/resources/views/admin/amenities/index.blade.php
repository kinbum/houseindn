@extends('webed-core::admin._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <div class="layout-1columns">
        <div class="column main">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon-layers font-dark"></i>
                        {{ trans('features::base.features') }} {{ trans('features::base.amenities') }}
                    </h3>
                    <div class="box-tools">
                        <a class="btn btn-transparent green btn-sm"
                           href="{{ route('amenities.create.get') }}">
                            <i class="fa fa-plus"></i> {{ trans('webed-core::base.form.create') }}
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    {!! $dataTable or ''!!}
                </div>
            </div>
        </div>
    </div>
@endsection