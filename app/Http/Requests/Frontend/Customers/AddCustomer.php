<?php

namespace App\Http\Requests\Frontend\Customers;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomer extends FormRequest
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
            'CustomerCode'=>'required|min:3',
            'CustomerName'=>'required',
            'CustomerNIC'=>'required|min:10',
            'Address1'=>'required|min:3',
            'CreditLimit'=>'required',
            
        ];
    }
}
