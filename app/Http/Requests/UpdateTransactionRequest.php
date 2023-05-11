<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            //
            'transation_type' => 'required',
            'member_id' => 'required',
            'transation_date' => 'required',
            'total_item' => 'required',
            'total_price' => 'required',
            'status' => 'required',
            'order_notes' => 'required',
        ];
    }
}
