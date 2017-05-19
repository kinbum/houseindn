<?php namespace WebEd\Plugins\Features\Http\Requests;

use WebEd\Base\Http\Requests\Request;

class CreateAssetRequest extends Request
{
    public function rules()
    {
        return [
            'assets.name' => 'string|max:255|required',
            'assets.slug' => 'string|max:255|nullable|unique:assets,slug',
            'assets.description' => 'string|max:1000|nullable',
        ];
    }
}
