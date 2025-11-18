<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'transaction_type' => ['required', 'in:income,expense'],'transaction_date' => ['required','date'], 'category_id' =>['required','exists:categories,id'],'amount' => ['required','numeric','gt:0'],'description' =>['nullable','string', 'max:1000'], 
        ];
    }

    public function messages():array
    {
        return [
            'amount.gt' => 'El monto debe ser mayor a cero.','category_id.required' => 'Debe seleccionar una categoria.',
        ];
    }
}
