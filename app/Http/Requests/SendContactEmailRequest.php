<?php

namespace App\Http\Requests;

use App\Rules\ValidRecaptcha;
use Illuminate\Foundation\Http\FormRequest;

class SendContactEmailRequest extends FormRequest
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

                'message' => 'required',
                'captyResponse'=>['required', new ValidRecaptcha],
            ];
            //

    }
}
