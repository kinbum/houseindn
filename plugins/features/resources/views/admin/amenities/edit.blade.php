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
                        <input required type="text" name="amenities[name]"
                               class="form-control"
                               value="{{ $object->name or '' }}"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('webed-core::base.form.slug') }}</b>
                        </label>
                        <input type="text" name="amenities[slug]"
                               class="form-control"
                               value="{{ $object->slug or '' }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('webed-core::base.form.label') }}</b>
                        </label>
                        <input type="text" name="amenities[label]"
                               class="form-control"
                               value="{{ $object->label or '' }}"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('webed-core::base.form.description') }}</b>
                        </label>
                        <textarea rows="3" name="amenities[description]"
                                class="form-control"
                                style="height: 115px">{{ $object->description or '' }}</textarea>
                    </div>
                </div>
            </div>
            @php do_action(BASE_ACTION_META_BOXES, 'main', 'FEATURES_AMENITIES', null) @endphp
        </div>
        <div class="column right">
            @php do_action(BASE_ACTION_META_BOXES, 'top-sidebar', 'FEATURES_AMENITIES', null) @endphp
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
                    <div class="form-group">
                        <label class="control-label">
                            <b>{{ trans('features::base.choose_type') }}</b>
                        </label>
                        {!! form()->select('amenities[types]', [
                            'normal' => trans('features::base.amenities_type.normal'),
                            'safety' => trans('features::base.amenities_type.safety'),
                            'space' => trans('features::base.amenities_type.space'),
                            'bed' => trans('features::base.amenities_type.bed'),
                        ], $object->types, ['class' => 'form-control']) !!}
                    </div>
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
