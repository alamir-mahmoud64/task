<?php

namespace App\Http\Requests;

use App\Traits\APIValidationErrorsTrait;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'product_id'=>"required|integer|exists:products,id",
            'quantity'=>"required|integer|min:1"
        ];
    }
}
