<?php

namespace App\Http\Requests\Frontend\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceSummery extends FormRequest
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
            'Inv_No'=>'required',
            'Mode'=>'required'
        ];
    }
}
