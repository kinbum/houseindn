<?php namespace WebEd\Plugins\Features\Http\Requests;

use WebEd\Base\Http\Requests\Request;

class UpdateAssetRequest extends Request
{
    public function rules()
    {
        return [
            'assets.name' => 'string|max:255|required',
            'assets.slug' => 'string|max:255|nullable|unique:assets,slug,' . request()->route()->parameter('id'),
            'assets.description' => 'string|max:1000|nullable',
        ];
    }
}
