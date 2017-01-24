<?php

namespace App\Http\Requests\Frontend\Quotations;

use Illuminate\Foundation\Http\FormRequest;

class AddQuotation extends FormRequest
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
            'QuotationNo'=>'required',
            'PayType'=>'required',
            'products'=>'required',
            'Quantity'=>'required|integer|min:1',
            'dis_per'=>'required|min:1'
        ];
    }
}
