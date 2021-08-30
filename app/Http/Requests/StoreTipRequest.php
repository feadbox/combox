<?php

namespace App\Http\Requests;

use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTipRequest extends FormRequest
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
        $positionIds = Position::where('included_to_tip', true)->pluck('id')->toArray();

        return [
            'user' => ['required', Rule::exists(User::class, 'id')->whereIn('position_id', $positionIds)],
            'period' => ['required', 'date'],
            'price' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
        ];
    }
}
