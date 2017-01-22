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

class CancelInvoiceController extends Controller {

    public function cancelinvoice() {
        return view('frontend/InterfacesKT/Invoice/CancelInvoices');
    }

    public function getInvoiceData($code, $code2) {

        $checkmode = 'D';
        if ($code == 'true') {
            $checkmode = 'C';
        }



        $data = DB::table('tblt_invoice')->where([
                    ['Inv_No', $code2],
                    ['Inv_Mode', $checkmode],
                ])->get();

        foreach ($data as $d) {
            $mode = $d->Inv_Mode;

            if ($mode == 'C') {
                $date = $d->Inv_Time;
                $customer = $d->Inv_CusCode;
                $gross = $d->Inv_GrossAmount;
                $dis = $d->Inv_ItemDiscount;
                $net = $d->Inv_NetAmount;
                $payment = $d->Inv_CashGiven;
                $sale = $d->Inv_CashSale;

                $record = '' . $date . ',' . $customer . ',' . $gross . ',' . $dis . ',' . $net . ',' . $payment . ',' . $sale;
                echo $record;
            } elseif ($mode == 'D') {
                $date = $d->Inv_Time;
                $customer = $d->Inv_CusCode;
                $gross = $d->Inv_GrossAmount;
                $dis = $d->Inv_ItemDiscount;
                $net = $d->Inv_NetAmount;
                $payment = $d->Inv_CashGiven;
                $sale = $d->Inv_CreditSale;
                $record = '' . $date . ',' . $customer . ',' . $gross . ',' . $dis . ',' . $net . ',' . $payment . ',' . $sale;
                echo $record;
            }
            
            


            /* $recs=DB::table('tblt_invoicedetail')->where([
              ['Inv_No', $code2],
              ['Inv_Mode', $checkmode],
              ])->get();

              foreach($recs as $r)
              {
              $product=$r->Inv_ProCode;
              $qty=$r->Inv_Qty;
              $prc=$r->Inv_Price;
              $disper=$r->$r->Inv_DisPer;
              $gross=$r->Inv_GrossAmount;

              } */
        }
    }

    public function savecancel(Requests\Frontend\Invoices\CancelInvoice $request) {
        $checkmode = 'D';

        $no = $request->Inv_No;
        $mode = $request->PayType;
        $remark = $request->Reason;


        if ($mode == 'true') {
            $checkmode = 'C';
        }

        $results = DB::table('tblt_invoice')->where([
                    ['Inv_No', $no],
                    ['Inv_Mode', $checkmode],
                ])->get();

        $c_inno = DB::table('tblt_cancelledinvoice')->select('Inv_No')->orderby('Inv_No', 'DESC')->first();

        foreach ($results as $result) {

            if ($checkmode == 'D') {
                $customer = $result->Inv_CusCode;
                $gross = $result->Inv_GrossAmount;
                $dis = $result->Inv_ItemDiscount;
                $net = $result->Inv_NetAmount;
                //$payment=$result->Inv_DueAmount;
                $sale = $result->Inv_CreditSale;


                $st = DB::insert('insert into tblt_cancelledinvoice 
            (Inv_No,Inv_OutCode,Inv_CancelledInvNo,Inv_Mode,Inv_Date,Inv_Time,Inv_UserCode,Inv_AssCode,Inv_CusCode,Inv_GrossAmount,Inv_BillDiscount,Inv_ItemDiscount,Inv_PromoDiscount,Inv_NetAmount,Inv_CostAmount,Inv_CreditSale,Inv_Change,Inv_DueAmount,Inv_ReturnValue,Inv_ReturnCostValue,Inv_Remark,Inv_CancelUserCode,Inv_ChequeSale) 
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
                                , [str_pad($c_inno->Inv_No + 1, 8, '0', STR_PAD_LEFT), 1, $no, $checkmode, \Carbon\Carbon::now('Asia/Colombo'), \Carbon\Carbon::now('Asia/Colombo'), Auth::user()->id, Auth::user()->id, $customer, $gross, 0, $dis, 0, $net, 0, $sale, 0, $net, 0, 0, $remark, Auth::user()->id, 0]);
                
                DB::table('tblm_customer')->where('Cus_Code',$customer)->increment('Cus_CreditLimit',$net);
                
                
            } else if ($checkmode == 'C') {
                $customer = $result->Inv_CusCode;
                $gross = $result->Inv_GrossAmount;
                $dis = $result->Inv_ItemDiscount;
                $net = $result->Inv_NetAmount;
                $payment = $result->Inv_CashGiven;
                $sale = $result->Inv_CashSale;
                $st = DB::insert('insert into tblt_cancelledinvoice (Inv_No,Inv_OutCode,Inv_CancelledInvNo,Inv_Mode,Inv_Date,Inv_Time,Inv_UserCode,Inv_AssCode,Inv_CusCode,Inv_GrossAmount,Inv_BillDiscount,Inv_ItemDiscount,Inv_PromoDiscount,Inv_NetAmount,Inv_CostAmount,Inv_CashSale,Inv_Change,Inv_DueAmount,Inv_ReturnValue,Inv_ReturnCostValue,Inv_Remark,Inv_CancelUserCode,Inv_ChequeSale) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [str_pad($c_inno->Inv_No + 1, 8, '0', STR_PAD_LEFT), 1, $no, $mode, \Carbon\Carbon::now('Asia/Colombo'), \Carbon\Carbon::now('Asia/Colombo'), Auth::user()->id, Auth::user()->id, $customer, $gross, 0, $dis, 0, $net, 0, $sale, 0, $net, 0, 0, $remark, Auth::user()->id, 0]);
                echo $st;
            }
        }
        
        $c_innodet = DB::table('tblt_cancelledinvoice')->select('Inv_No')->orderby('Inv_No', 'DESC')->first();
        $cindet = $c_innodet->Inv_No+1;
        $count=0;
        
        $details=DB::table('tblt_invoicedetail')->where([
                    ['Inv_No', $no],
                    ['Inv_Mode', $checkmode],
                ])->get();
        
        foreach($details as $detail)
        {
            $count=$count+1;
            if ($checkmode == 'D') {
                
                $st = DB::insert('insert into tblt_cancelledinvoicedetail 
            (Inv_No,Inv_OutCode,Inv_LineNo,Inv_Mode,Inv_Date,Inv_ProCode,Inv_Qty,Inv_RtnQty,Inv_Price,Inv_Disper,Inv_Disval,Inv_PromoDisper,Inv_PromoDisval,Inv_GrossAmount,Inv_BillDisper,Inv_Amount,Inv_Cost,Inv_SupCode,Inv_Description) 
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
                                , [str_pad($cindet, 8, '0', STR_PAD_LEFT), 1, $count, $checkmode, \Carbon\Carbon::now('Asia/Colombo'),$detail->Inv_ProCode,$detail->Inv_Qty, 0, $detail->Inv_Price, $detail->Inv_Disper, $detail->Inv_Disval, $detail->Inv_PromoDisper,  $detail->Inv_PromoDisval, $detail->Inv_GrossAmount, $detail->Inv_BillDisper, $detail->Inv_Amount, $detail->Inv_Cost,  $detail->Inv_SupCode, $detail->Inv_Description]);  
            
                DB::table('tblm_productdetail')->where('Pro_Code',$detail->Inv_ProCode)->increment('Pro_Stock',$detail->Inv_Qtyt);
            }
            
            else if($checkmode == 'C')
            {
                $st = DB::insert('insert into tblt_cancelledinvoicedetail 
            (Inv_No,Inv_OutCode,Inv_LineNo,Inv_Mode,Inv_Date,Inv_ProCode,Inv_Qty,Inv_RtnQty,Inv_Price,Inv_Disper,Inv_Disval,Inv_PromoDisper,Inv_PromoDisval,Inv_GrossAmount,Inv_BillDisper,Inv_Amount,Inv_Cost,Inv_SupCode,Inv_Description) 
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
                                , [str_pad($cindet, 8, '0', STR_PAD_LEFT), 1, $count, $checkmode, \Carbon\Carbon::now('Asia/Colombo'),$detail->Inv_ProCode,$detail->Inv_Qty, 0, $detail->Inv_Price, $detail->Inv_Disper, $detail->Inv_Disval, $detail->Inv_PromoDisper,  $detail->Inv_PromoDisval, $detail->Inv_GrossAmount, $detail->Inv_BillDisper, $detail->Inv_Amount, $detail->Inv_Cost,  $detail->Inv_SupCode, $detail->Inv_Description]);  
            }
        }
        
        return redirect('cancelinvoice');
    }
}
