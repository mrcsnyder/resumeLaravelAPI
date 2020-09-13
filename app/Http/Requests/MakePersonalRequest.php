<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakePersonalRequest extends FormRequest
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
        return [

            'user_id' => 'required|unique:personal',
            'name' => 'required',
            'current_role' => 'required',
            'professional_intro' => 'required',
            'hobbies_interests' => 'required',

        ];
    }
}
