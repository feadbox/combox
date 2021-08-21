<?php

namespace App\Http\Requests;

use App\Eloquent\Enums\PaymentTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSalaryRequest extends FormRequest
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
            'user' => ['required', Rule::exists(User::class, 'id')],
            'type' => ['required', Rule::in(PaymentTypeEnum::getValues())],
            'price' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
            'salary_period' => ['required', 'date'],
        ];
    }
}
