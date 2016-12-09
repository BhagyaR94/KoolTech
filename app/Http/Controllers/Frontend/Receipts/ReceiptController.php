<?php

namespace App\Http\Controllers\Frontend\Receipts;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Receipts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;

class ReceiptController extends Controller
{
    public function newreceipt()
    {
        $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();

        $products = DB::table('tblm_product')->select('Pro_Code','Pro_Description')->get();

        $invoice_detail=DB::table('tblt_invoice')->select('Inv_No','Inv_NetAmount')->orderby('Inv_No','DESC')->first();

       
        return view('Frontend/InterfacesKT/Receipts/Receipts',['customers'=>$customers,'products'=>$products,'invoice_detail'=>$invoice_detail]);
    }
    
    public function savereceipt(Receipts\SaveReceipt $request)
    {
        $receipt=$request->all();
        
        $paytype=$request->PayType;
        
        if($paytype=="CH")
        {
            return $paytype;
        }
        
        else if($paytype=="CS")
        {
            return $paytype;
        }
        
        
    }
}
