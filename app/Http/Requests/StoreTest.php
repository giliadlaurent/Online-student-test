<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->isAdministrator()) {
            return true;
        }

        if (Auth::user()->isModerator()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|string|max:255",
            "question_count" => "required|integer|min:1",
            "question_count_to_fail" => "integer|min:0",
            "time_limit" => "integer|min:0",
            "group_id" => "integer|exists:groups,id|min:1"
        ];
    }
}
