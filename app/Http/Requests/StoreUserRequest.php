<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'phone' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email', 'max:191'],
            'started_at' => ['required', 'date'],
            'position' => ['required', Rule::exists(Position::class, 'id')],
            'branch' => ['required', Rule::exists(Branch::class, 'id')],
            'salary' => ['required'],
        ];
    }
}
