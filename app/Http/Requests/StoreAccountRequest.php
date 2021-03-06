<?php

namespace App\Http\Requests;

use App\Eloquent\Enums\AccountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccountRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'account_type' => ['required', Rule::in(AccountTypeEnum::getValues())],
            'bank_account_name' => ['nullable', 'string', 'max:191'],
            'bank_account_iban' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'string', 'email', 'max:191'],
            'phone' => ['nullable', 'string', 'max:191'],
        ];
    }
}
