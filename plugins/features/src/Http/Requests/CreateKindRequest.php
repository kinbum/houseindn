<?php namespace WebEd\Plugins\Features\Http\Requests;

use WebEd\Base\Http\Requests\Request;

class CreateKindRequest extends Request
{
    public function rules()
    {
        return [
            'kinds.name' => 'string|max:255|required',
            'kinds.slug' => 'string|max:255|nullable|unique:kinds,slug',
            'kinds.description' => 'string|max:1000|nullable',
        ];
    }
}
