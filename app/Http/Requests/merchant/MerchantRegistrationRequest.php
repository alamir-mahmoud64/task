<?php

namespace App\Http\Requests\merchant;

use App\Traits\APIValidationErrorsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class MerchantRegistrationRequest extends FormRequest
{
    use APIValidationErrorsTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
/*    public function authorize(): bool
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
            'store_name'=>'required|string|min:1|max:100',
            'is_vat_included'=>'required|boolean',
            'percentage'=>'required|decimal:2',
            'shipping_cost'=>'sometimes|decimal:2',
            'email'=>'required|email|unique:merchants',
            'password'=>['required', 'confirmed', Password::min(9)->mixedCase()->numbers()->symbols()],
        ];
    }
}
