<?php

namespace App\Http\Controllers\Frontend\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;
use Illuminate;

class DebtorsController extends Controller
{
    public function index()
    {
        $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();
        return view('frontend.InterfacesKT.Customers.Debtors',['customers'=>$customers]);
    }
}
