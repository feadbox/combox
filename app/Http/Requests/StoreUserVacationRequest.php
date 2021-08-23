<?php

namespace App\Http\Requests;

use App\Eloquent\Enums\VacationReasonEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserVacationRequest extends FormRequest
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
            'reason' => ['required', Rule::in(VacationReasonEnum::getValues())],
            'start' => ['required', 'date'],
            'end' => ['nullable', 'date'],
        ];
    }
}
