<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarModRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model' => ['required', 'max:255'],
            'year_of_manufacture' => ['required', 'integer', 'between:1900,' .date('Y')],
            'power' => ['required', 'integer', 'between:1,10000'],
            'torque' => ['required', 'integer', 'between:1,10000'],
            'zero_to_100' => ['required', 'decimal:0,1'],
            'weight' => ['required', 'integer'],
            'top_speed' => ['required', 'integer'],
            'make_id' => ['required', 'integer', 'exists:makes,id'],
            'description' => ['required', 'string'],
            'download_link' => ['required', 'url'],
            'is_premium' => ['boolean'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
        ];
    }
}
