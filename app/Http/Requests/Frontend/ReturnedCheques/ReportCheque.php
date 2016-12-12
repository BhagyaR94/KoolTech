<?php

namespace App\Http\Requests\Frontend\ReturnedCheques;

use Illuminate\Foundation\Http\FormRequest;

class ReportCheque extends FormRequest
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
            'Type'=>'required',
            'ReportNo'=>'required',
            'Customer'=>'required',
            'Amount'=>'required',
            'Bank'=>'required',
            'Cheque_No'=>'required',
            
        ];
    }
}
