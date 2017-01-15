<?php

namespace App\Http\Controllers\Frontend\CreditSet;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;

class CreditSetController extends Controller
{
    public function creditset()
    {
        $last_Set=DB::table('tbla_creditset')->select('Crd_No')->orderby('Crd_No', 'desc')->first();
        
        return view('frontend/InterfacesKT/Credit/CreditSet',['last_Set' => $last_Set]);
    }
    
    public function getcusname($code)
    {
        $cus_name=DB::table('tblm_customer')->where('Cus_Code',$code)->value("Cus_Name");
        echo $cus_name;
    }
    
    public function getreceiptdata($code)
    {
        
        $receiptdata=DB::table('tbla_receipts')->where('Rcp_No',$code)->get();
        
        foreach ($receiptdata as $rcps)
        {
            $rcp_details=''.$rcps->Rcp_Amount.'-'.$rcps->Rcp_BalAmount;
            return $rcp_details;
        }
    }
}
