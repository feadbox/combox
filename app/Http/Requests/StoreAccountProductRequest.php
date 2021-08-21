<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccountProductRequest extends FormRequest
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
            'product' => ['required', Rule::exists(Product::class, 'id')],
            'branch' => ['required', Rule::exists(Branch::class, 'id')],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
        ];
    }
}
