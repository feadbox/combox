<?php

namespace App\Http\Requests;

use App\Eloquent\Enums\UnitEnum;
use App\Models\Account;
use Feadbox\Tags\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:191'],
            'unit' => ['required', Rule::in(UnitEnum::getValues())],
            'tags' => ['required', 'array'],
            'tags.*' => [Rule::exists(Tag::class, 'id')],
            'accounts' => ['required', 'array'],
            'accounts.*' => [Rule::exists(Account::class, 'id')],
        ];
    }
}
