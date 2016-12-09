<?php

namespace App\Http\Requests\Frontend\Receipts;

use Illuminate\Foundation\Http\FormRequest;

class SaveReceipt extends FormRequest
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
            'ReceiptNo'=>'required|min:8',
            'CustomerID'=>'required',
            'PayType'=>'required',
            'RecType'=>'required',
            'Bank'=>'required',
            'AccountNo'=>'required',
            'ChequeNo'=>'required',
            'RealizeDate'=>'required',
            'Amount'=>'required'
        ];
    }
}
