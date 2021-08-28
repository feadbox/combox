<?php

namespace App\Http\Requests;

use App\Eloquent\Enums\AccountTypeEnum;
use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccountPaymentRequest extends FormRequest
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
            'tags' => ['required', 'string', 'max:500'],
            'relation' => ['nullable', Rule::exists(Account::class, 'id')->where('account_type', AccountTypeEnum::Account)],
            'description' => ['nullable', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
        ];
    }
}
