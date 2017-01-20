<?php

namespace App\Http\Controllers\Frontend\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;
use Illuminate;

class InvoiceSummeryController extends Controller
{
    public function invoicesum()
    {
       $results= DB::table('tblt_invoice')->orderby('Inv_No','DESC')->paginate(10);
        return view('frontend/InterfacesKT/Invoice/InvoiceSummery',['results'=>$results]);
    }


    public function getInvoiceData(Requests\Frontend\Invoices\InvoiceSummery $request)
    {
       $results= DB::table('tblt_invoice')->where([
                    ['Inv_No', $request->Inv_No],
                    ['Inv_Mode', $request->Mode],
                ])->get();
        return view('frontend/InterfacesKT/Invoice/InvoiceSummery',['results'=>$results]);
    }
}
