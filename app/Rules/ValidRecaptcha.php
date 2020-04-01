<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use GuzzleHttp\Client;

class ValidRecaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //


        //Validate ReCaptcha
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);
        $response = $client->post('siteverify', [
            'query' => [
                // 'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'secret' => '6Lc6uOUUAAAAAHZPtfFl5j5w4LhWQqw1fzkTYcLD',

                'response' => $value
            ]
        ]);
        return json_decode($response->getBody())->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect ReCaptcha.';
    }
}
