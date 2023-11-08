<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Unique;

class UpdateMemberRequest extends FormRequest
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
        $memberId = $this->route('member');

        return [
            //
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                (new Unique('members', 'nik'))->ignore($memberId),
            ],
            'member_name' => 'required',
            'phone_number' => [
                'required',
                'regex:/^\+628[1-9]\d{7,11}$/',
                (new Unique('members', 'phone_number'))->ignore($memberId),
            ],
            'address' => [
                'required',
                (new Unique('members', 'address'))->ignore($memberId),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withInput()->withErrors($validator->errors())->with('error', 'Gagal menyimpan data.')
        );
    }
}
