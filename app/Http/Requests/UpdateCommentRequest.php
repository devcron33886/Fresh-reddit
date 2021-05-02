<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comment_edit');
    }

    public function rules()
    {
        return [
            'post_id' => [
                'required',
                'integer',
            ],
            'comment_text' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
