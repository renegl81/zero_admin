<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (isset($this->id)) {
            $user = User::findOrFail($this->id);

            return [
                'name' => "required|unique:users,name,{$this->id}",
                'email' => "required|email|unique:users,email,{$user->id}",
                'password' => "required,{$this->id}|confirmed|min:6",
            ];
        }

        return [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
