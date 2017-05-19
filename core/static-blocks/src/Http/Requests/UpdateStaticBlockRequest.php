<?php namespace WebEd\Base\StaticBlocks\Http\Requests;

use WebEd\Base\Http\Requests\Request;

class UpdateStaticBlockRequest extends Request
{
    public function rules()
    {
        return [
            'static_block.title' => 'required|min:3|string|max:255',
            'static_block.slug' => 'string|max:255|nullable|unique:static_blocks,slug,' . request()->route()->parameter('id'),
            'static_block.content' => 'string|required',
            'static_block.status' => 'string|required|in:activated,disabled',
        ];
    }
}
