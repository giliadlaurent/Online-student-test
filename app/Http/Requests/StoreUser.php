<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUser extends FormRequest
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
        $start_pos = strpos(request()->path(), "users/") + 6;
        $length = strpos(request()->path(), "/edit") - $start_pos;
        $user_id = substr(request()->path(), $start_pos, $length);

        return [
            "name" => "required|string|max:255",
            "email" => [
                "required",
                "email",
                Rule::unique('users')->ignore($user_id),
                "max:255",
            ],
            "password" => "sometimes|required|min:8",
            "group_id" => "integer|exists:groups,id|min:1",
            "enabled" => "required|boolean",
            "access_level" => "required|integer|min:1|max:3|access_mod",
        ];
    }
}
