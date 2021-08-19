<?php

namespace App\Http\Requests;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccountTransferRequest extends FormRequest
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
            'from' => ['required', Rule::exists(Account::class, 'id')],
            'to' => ['required', Rule::exists(Account::class, 'id')],
            'price' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
        ];
    }
}
