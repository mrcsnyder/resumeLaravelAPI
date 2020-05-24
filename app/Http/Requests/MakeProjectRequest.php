<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeProjectRequest extends FormRequest
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
            'title' => 'required',
            'full_detail' => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
// use trans instead on Lang
        return [
            'title.required' => 'Sorry!  The Project Name/Description is required!',
            'full_detail.required' => 'Sorry!  The Detailed Explanation is required!'

        ];
    }
}
