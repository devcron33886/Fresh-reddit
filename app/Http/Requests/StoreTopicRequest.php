<?php

namespace App\Http\Requests;

use App\Models\Topic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTopicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('topic_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:topics',
            ],
        ];
    }
}