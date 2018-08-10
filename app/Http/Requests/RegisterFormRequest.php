<?php
/** Credit for this code goes to arjun --> https://arjunphp.com/laravel-5-6-rest-api-jwt-authentication/ 
**/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'alias' => 'required|string|unique:users',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8' 
        ];
    }
}
