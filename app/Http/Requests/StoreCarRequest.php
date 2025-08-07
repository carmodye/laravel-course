<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreCarRequest extends FormRequest
{
    // will stop on first failure
    // protected $stopOnFirstFailure = true;
    // will redirect to a specific URL on failure
    // protected $redirect = '/cars/create';
    // will redirect to a named route on failure
    // protected $redirectRoute = 'car.index';
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // where we check auth
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'maker_id' => 'required|exists:makers,id',
            'model_id' => 'required|exists:models,id',
            'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'price' => 'required|integer|min:0',
            'vin' => 'required|string|size:17',
            'mileage' => 'required|integer|min:0',
            'car_type_id' => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'phone' => 'required|string|min:9',
            'description' => 'nullable|string',
            'published_at' => 'nullable|string',
            'features' => 'array',
            'features.*' => 'string',
            'images' => 'array',
            //            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            'images.*' => File::image()
                ->max(2048)
            //
        ];
    }



    public function messages(): array
    {
        // should use either messages or attributes for error messages
        return [
            'maker_id.required' => 'The maker field is required.',
            'model_id.required' => 'The model field is required.',
            'year.required' => 'The year field is required.',
            'year.integer' => 'The year must be an integer.',
            'year.min' => 'The year must be at least 1900.',
            'year.max' => 'The year cannot be in the future.',
            //'price.required' => 'The price field is required.',
            'price.integer' => 'The price must be an integer.',
            'price.min' => 'The price must be at least 0.',
            // Add more custom messages as needed
        ];
    }

    public function attributes(): array
    {
        return [
            'maker_id' => 'Maker',
            'model_id' => 'Model',
            'year' => 'Year',
            'price' => 'Price (in USD)',
            'vin' => 'VIN',
            'mileage' => 'Mileage',
            'car_type_id' => 'Car Type',
            'fuel_type_id' => 'Fuel Type',
            'city_id' => 'City',
            'address' => 'Address',
            'phone' => 'Phone',
            'description' => 'Description',
            'published_at' => 'Published At',
            // Add more attributes as needed
        ];
    }

    // modify data before validation
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         // Take submitted vin code and convert into uppercase
    //         'vin' => strtoupper($this->vin)
    //     ]);
    // }

    // does rule modification after validation
    protected function passedValidation()
{
    $this->replace([
        'vin' => strtoupper($this->vin)
    ]);
}
}
