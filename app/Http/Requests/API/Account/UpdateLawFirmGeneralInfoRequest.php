<?php

namespace App\Http\Requests\API\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLawFirmGeneralInfoRequest extends FormRequest
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
     * @return string[]
     */
    public function messages()
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user= auth()->user();
        $law_firm = $user->law_firm;
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'law_firm_name' => 'required|string',
            'law_firm_website' => 'nullable|url',
            'description' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'user_name' => 'required|alpha_dash|unique:law_firms,user_name,'.$law_firm->id,
            'zip_code' => 'required|string',
            'law_firm_categories' => 'required'
        ];
    }
}
