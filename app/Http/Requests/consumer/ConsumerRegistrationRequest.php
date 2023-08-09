<?php

namespace App\Http\Requests\consumer;

use App\Traits\APIValidationErrorsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ConsumerRegistrationRequest extends FormRequest
{
    use APIValidationErrorsTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    /*public function authorize(): bool
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|string|min:3|max:20',
            'last_name'=>'required|string|min:3|max:20',
            'email'=>'required|email|unique:consumers',
            'password'=>['required', 'confirmed', Password::min(9)->mixedCase()->numbers()->symbols()],
        ];
    }
}
