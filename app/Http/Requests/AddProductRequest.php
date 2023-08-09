<?php

namespace App\Http\Requests;

use App\Traits\APIValidationErrorsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AddProductRequest extends FormRequest
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
        $merchant = Auth::guard('merchant-api')->user();
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $rules = [
            'name'=>'required|array',
            'description'=>'required|array'
        ];
        foreach ($locales as $locale){
            $rules['name.'.$locale] = 'required|string|min:10|max:190';
            $rules['description.'.$locale] = 'required|string|min:10|max:2000';
        }
        $rules['price']='required|decimal:2|min:1';
        return $rules;
    }
}
