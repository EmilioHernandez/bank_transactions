<?php

namespace App\Http\Requests;

use App\Constants\Messages;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'amount' => 'required',
        ];
    }

    /**
     * @return bool
     */
    public function adding(): bool
    {
        return $this->has('addMoney');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'amount.required' => Messages::ACCOUNT_AMOUNT_REQUIRED,
        ];
    }
}
