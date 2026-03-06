<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class AddLawyerReviewRequest extends FormRequest
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
        $customer = $user->customer;
        return [
            'rating' => 'required|numeric|max:5',
            'experience' => 'required|numeric|max:5',
            'service' => 'required|numeric|max:5',
            'communication' => 'required|numeric|max:5',
            'comment' => 'required|string',
            'lawyer_id' => 'required',
        ];
    }
}
