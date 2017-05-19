<?php namespace WebEd\Plugins\Features\Http\Requests;

use WebEd\Base\Http\Requests\Request;

class CreateAmenitiesRequest extends Request
{
    public function rules()
    {
        return [
            'amenities.name' => 'string|max:255|required',
            'amenities.slug' => 'string|max:255|nullable|unique:amenities,slug',
            'amenities.description' => 'string|max:1000|nullable',
            'amenities.label' => 'string|max:255|nullable',
            'amenities.types' => 'string|required|in:normal,safety,space,bed',
        ];
    }
}
