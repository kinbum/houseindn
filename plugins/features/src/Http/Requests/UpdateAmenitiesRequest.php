<?php namespace WebEd\Plugins\Features\Http\Requests;

use WebEd\Base\Http\Requests\Request;

class UpdateAmenitiesRequest extends Request
{
    public function rules()
    {
        return [
            'amenities.name' => 'string|max:255|required',
            'amenities.slug' => 'string|max:255|nullable|unique:amenitiess,slug,' . request()->route()->parameter('id'),
            'amenities.description' => 'string|max:1000|nullable',
            'amenities.label' => 'string|max:255|nullable',
            'amenities.types' => 'string|required|in:normal,safety,space,bed',
        ];
    }
}
