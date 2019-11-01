<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreQuestion extends FormRequest
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
            "test_id" => "integer|exists:tests,id|min:1",
            "title" => "required|string|max:255",
            "question" => "required|string",
            "question_type" => "string|in:radio,checkbox|max:255",
            "correct_answers" => "integer|min:1",
            "multiple_anwsers_question" => "boolean",
            "options.*.option" => "required|string|max:255",
            "options.*.correct_answer" => "boolean"
        ];
    }
}
