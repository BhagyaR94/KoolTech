<?php

namespace App\Http\Requests\Frontend\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class AddInvoice extends FormRequest
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

            'invoiceid'=>'required|min:7',
            'cid'=>'required',
            'products'=>'required',
            'qty'=>'required|integer|min:1',
            'dis_per'=>'required|min:1'
        ];
    }
}
