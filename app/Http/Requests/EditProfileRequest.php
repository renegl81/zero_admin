<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
        $user = User::findOrFail($this->id);

        return [
            'name' => 'required|unique:users,name',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'current_sector.required' => 'The current sector field is required.',
            'current_sector.numeric' => 'The current sector field must be a number.',
        ];
    }
}
