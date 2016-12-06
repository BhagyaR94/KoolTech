<?php

namespace App\Http\Controllers\Frontend\Customers;

use \App\Http\Requests\Frontend\Customers;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function addcustomer()
    {
        return view('Frontend/InterfacesKT/RegCustomer');
    }
    
    public function addnewcustomer(Customers\AddCustomer $request)
    {
        
    }
}
