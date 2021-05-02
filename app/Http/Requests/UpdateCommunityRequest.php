<?php

namespace App\Http\Requests;

use App\Models\Community;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCommunityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('community_edit');
    }

    public function rules()
    {
        return [
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
            'name' => [
                'string',
                'required',
                'unique:communities,name,' . request()->route('community')->id,
            ],
            'description' => [
                'required',
            ],
            'slug' => [
                'string',
                'required',
            ],
            'topics.*' => [
                'integer',
            ],
            'topics' => [
                'required',
                'array',
            ],
        ];
    }
}
