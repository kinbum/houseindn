@extends('webed-core::admin._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
{!! Form::open(['class' => 'js-validate-form']) !!}
    <div class="layout-2columns sidebar-right">
        <div class="column main">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('webed-core::base.form.basic_info') }}</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('webed-core::base.form.title') }}</b>
                            <span class="required">*</span>
                        </label>
                        <input required type="text" name="kinds[name]"
                               class="form-control"
                               value="{{ old('kinds.name') }}"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('webed-core::base.form.slug') }}</b>
                        </label>
                        <input type="text" name="kinds[slug]"
                               class="form-control"
                               value="{{ old('kinds.slug') }}" autocomplete="off">
                    </div>
                 
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('webed-core::base.form.description') }}</b>
                        </label>
                        <textarea rows="3" name="kinds[description]"
                                class="form-control"
                                style="height: 115px">{{ old('kinds.description') }}</textarea>
                    </div>
                </div>
            </div>
            @php do_action(BASE_ACTION_META_BOXES, 'main', 'FEATURES_KINDS', null) @endphp
        </div>
        <div class="column right">
            @php do_action(BASE_ACTION_META_BOXES, 'top-sidebar', 'FEATURES_KINDS', null) @endphp
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('webed-core::base.form.publish') }}</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-check"></i> {{ trans('webed-core::base.form.save') }}
                        </button>
                        <button class="btn btn-success" type="submit"
                                name="_continue_edit" value="1">
                            <i class="fa fa-check"></i> {{ trans('webed-core::base.form.save_and_continue') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection
