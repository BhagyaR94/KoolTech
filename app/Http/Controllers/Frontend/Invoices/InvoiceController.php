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
class InvoiceController extends Controller {

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoices() {
        $temp_inv = DB::table('tbl_new_temporary_invoice')->get();
        $gross = 0;
        $total_dis = 0;
        $total_disper = 0;
        $net = 0;

        foreach ($temp_inv as $temp) {
            $gross = $gross + ($temp->Price) * ($temp->Qty);
            $total_dis = $total_dis + ($temp->Dis_Val) * ($temp->Qty);
            $total_disper = ($total_dis * 100) / $gross;
            $net = $gross - $total_dis;
            $invoicecode = $temp->Invoice_No;
            $discription = $temp->Product_Desc;
        }


        $customers = DB::table('tblm_customer')->select('Cus_Code', 'Cus_Name')->get();

        $products = DB::table('tblm_product')->select('Pro_Code', 'Pro_Description')->get();

        $invoice_cr = DB::table('tblt_invoice')->where('Inv_Mode', 'D')->select('Inv_No')->orderby('Inv_No', 'DESC')->first();

        $invoice_cs = DB::table('tblt_invoice')->where('Inv_Mode', 'C')->select('Inv_No')->orderby('Inv_No', 'DESC')->first();

        return view('frontend/InterfacesKT/Invoices', ['customers' => $customers, 'products' => $products, 'temp_inv' => $temp_inv, 'gross' => $gross, 'total_dis' => $total_dis, 'total_disper' => $total_disper, 'net' => $net, 'invoice_cr' => $invoice_cr, 'invoice_cs' => $invoice_cs]);
    }

    /**
     *
     */

    /**
     * @param Requests\AddInvoice $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function feed_records(AddInvoice $request) {

        if (isset($_POST['Add'])) {
            $request->only(['invoiceid', 'cid', 'poroducts', 'qty']);
            $id = $request->input('invoiceid');

            $products = $request->input('products');
            $qty = $request->input('qty');
            $disper = $request->input('dis_per');
            $user = Auth::user()->name;
            $userid = Auth::user()->id;
            $product_data = DB::table('tblm_productdetail')->select('Pro_RetailPrice', 'Pro_DisPer', 'Pro_DisVal')->where('Pro_Code', $products)->first();
            $product_desc = DB::table('tblm_product')->where('Pro_Code', $products)->pluck('Pro_Description');
            $product_price = $product_data->Pro_RetailPrice;
            $product_dis_val = $product_price * ($disper / 100);
            $amount = ($product_price - $product_dis_val) * $qty;

            $temp_invoice = DB::insert('insert into tbl_new_temporary_invoice (Invoice_No, Salesman, Salesman_ID, Product_ID, Price, Dis_Per, Dis_Val, Qty, Bill_Dis_Val, Product_Desc) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$id, $user, $userid, $products, $product_price, $disper, $product_dis_val, $qty, $amount, $product_desc]);
            DB::table('tblm_productdetail')->where('Pro_Code',$products)->decrement('Pro_Stock',$qty);
            return redirect('invoices');
        } elseif (isset($_POST['save'])) {
            return 'save selected';
        }
    }

    public function drop_records(DropInvoice $request) {

        $request->only('product_id','qty','temp_id');
        $pid = $request->input('product_id');
        $qty= $request->input('qty');
        $tmp=$request->input('temp_id');
        DB::table('tbl_new_temporary_invoice')->where('temp_id', '=', $tmp)->delete();
        DB::table('tblm_productdetail')->where('Pro_Code',$pid)->increment('Pro_Stock',$qty);
        return redirect('invoices');
    }

    public function save_records(Requests\Frontend\Invoices\SaveInvoice $request) {
        $invoiceid = $request->InvoiceNo;
        $mode = $request->PayType;
        $amount = $request->Amount;
        $chq = $request->ChequeNo;
        $bnk = $request->Bank;
        $temp_inv = DB::table('tbl_new_temporary_invoice')->where('Invoice_No', $invoiceid)->get();
        $gross = 0;
        $total_dis = 0;
        $total_disper = 0;
        $net = 0;
        $line=0;
        $customer = '';
        $inv_det=0;


        $user = Auth::user()->name;
        $userid = Auth::user()->id;


        foreach($temp_inv as $temp1)
        {
            $line=$line+1;
            $tempid=$temp1->temp_id;
            $gross=($temp1->Price)*($temp1->Qty);
            $net=$gross-$temp1->Dis_Val;
            $inv_det=DB::insert('insert into tblt_invoicedetail(Inv_No, Inv_OutCode,Inv_LineNo, Inv_Mode, Inv_Date, Inv_ProCode,Inv_Qty,Inv_RtnQty,Inv_Price,Inv_DisPer,Inv_DisVal,Inv_PromoDisper,Inv_PromoDisval,Inv_GrossAmount,Inv_Amount,Inv_Cost, Inv_SupCode, Inv_Description) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$temp1->Invoice_No,1,$line,$mode,\Carbon\Carbon::now(),$temp1->Product_ID,$temp1->Qty,0,$gross,$temp1->Dis_Per,$temp1->Dis_Val,0,0,$net,$net,0,$userid,$temp1->Product_Desc]);
            
        }
        
        foreach ($temp_inv as $temp) {
            
            $gross = $gross + ($temp->Price) * ($temp->Qty);
            $total_dis = $total_dis + ($temp->Dis_Val) * ($temp->Qty);
            $total_disper = ($total_dis * 100) / $gross;
            $net = $gross - $total_dis;
        }
        $customername = DB::table('tblm_customer')->where('Cus_Code', $customer)->value('Cus_Name');



        $invoice = DB::insert('insert into tblt_invoice(Inv_No, Inv_OutCode, Inv_Mode, Inv_Date, Inv_Time, Inv_UserCode, Inv_AssCode, Inv_CusCode, Inv_GrossAmount, Inv_BillDiscount,Inv_ItemDiscount,Inv_PromoDiscount,Inv_NetAmount,Inv_CostAmount,Inv_CashGiven,Inv_CurrencyGiven,Inv_CashSale,Inv_CardSale,Inv_ChequeSale,Inv_CurrencySale, Inv_CreditSale,Inv_Change,Inv_DueAmount,Inv_ReturnValue,Inv_ReturnCostValue,Inv_Guide,Inv_GuidePer) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$invoiceid, 1, $mode, \Carbon\Carbon::now(), \Carbon\Carbon::now(), $user, $userid, $customer, $gross, $total_dis,$total_dis,0,$net, $net,0,0,0,0,0,0,0,0,0,0,0,0,0]);
        
        //$invoicepay = DB::insert('insert into tblt_invoicepayments (Inv_No, Inv_OutCode, Inv_LineNo, Inv_Mode, Inv_PayCode, Inv_Date, Inv_PayType, Inv_PayAmount, Inv_BnkCode) values (?,?,?,?,?,?,?,?,?)',[$invoiceid,0,1,$mode,$mode,\Carbon\Carbon::now(),$mode,]);
        
        if($inv_det==1)
            {
                DB::table('tbl_new_temporary_invoice')->where('temp_id', '=', $tempid)->delete();
              
            }
          
        //Bill Starts Here    
            
        $print_in=DB::table('tblt_invoicedetail')->where('Inv_No',$invoiceid)->get();
        $fpdf = new FPDF('L', 'mm', array(210, 154));
        $fpdf->AddPage();
        $fpdf->SetRightMargin(5);
        $fpdf->SetLeftMargin(5);
        $fpdf->SetFont('Courier', 'B', 28);
        $fpdf->Cell(190, 10, 'KOOLTECH ELECTRICALS', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 15);
        $fpdf->Cell(190, 10, 'No.18 B, Cross Street, Kandy', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 15);
        $fpdf->Cell(190, 10, 'Tel/Fax:081-2228666,Tel:077-3949282', 0, 0, 'C');

        //Receipt Type Name
        $fpdf->Ln(5);
        $fpdf->SetFont('Courier', 'B', 24);
        $fpdf->Cell(190, 10, 'Invoice', 0, 0, 'C');

        //end Receipt Type Name
        //$fpdf->Line(0, 38, 210, 38);

        //receipt body start
        $fpdf->Ln(10);
        $fpdf->SetFont('Courier', 'B', 12);
        $fpdf->Cell(100, 10, 'Invoice Mode: '.$mode, 0, 0, 'L');
        $fpdf->Ln(5);
        //$fpdf->Cell(100, 10, 'Payment Type: ', 0, 1, 'R');
        $fpdf->Cell(100, 10, 'Invoice No: '.$invoiceid, 0, 0, 'L');
        $fpdf->Cell(100, 10, 'Salesman: ', 0, 0, 'R');
        
        $fpdf->Ln(5);
        
        $fpdf->Cell(100, 10, 'Date: 2010-10-10', 0, 0, 'L');
        $fpdf->Cell(100, 10, 'Customer: '.$customername, 0, 0, 'R');
        $fpdf->Line(0, 58, 210, 58);
        $fpdf->Ln(10);
        $fpdf->Cell(15, 10, 'Count', 0, 0, 'L');
        $fpdf->Cell(40, 10, 'Code', 0, 0, 'L');
        $fpdf->Cell(60, 10, 'Description', 0, 0, 'L');
        $fpdf->Cell(25, 10, 'Price', 0, 0, 'L');
        $fpdf->Cell(20, 10, 'Qty', 0, 0, 'L');
        $fpdf->Cell(50, 10, 'Amount', 0, 1, 'L');
        $fpdf->Line(0, 68, 210, 68);
        $count=0;
        $net=0;
        foreach ($print_in as $print)
        {
            $count=$count+1;
            $net=$net+$print->Inv_Amount;
        $fpdf->Cell(15, 10, ''.$count, 0, 0, 'L');
        $fpdf->Cell(25, 10, ''.$print->Inv_ProCode, 0, 0, 'L');
        
        $fpdf->Cell(75, 10, ''.$print->Inv_Description, 0, 0, 'L');
        
        $fpdf->Cell(25, 10, ''.$print->Inv_GrossAmount, 0, 0, 'L');
        
        $fpdf->Cell(20, 10, ''.$print->Inv_Qty, 0, 0, 'L');
        
        $fpdf->Cell(50, 10, ''.$print->Inv_Amount, 0,0, 'L');
        $fpdf->Ln(5);
            if ($count>=5)
            {
                $fpdf->Line(0, 118, 210, 118);
                $fpdf->Ln(5);
                $fpdf->Cell(180, 10, 'Net Amount: ' . $net, 0, 0, 'R');
                $fpdf->Line(0, 128, 210, 128);
                $fpdf->Output('Invoice.pdf', 'I');

                return response('Hello World', 200)
                                ->header('Content-Type', 'application/pdf');
            }
        }
        //receipt body end
        //footer start
        //footer end
        //generate receipt pdf
        //$fpdf->Output('Invoice.pdf','D');
        $fpdf->Line(0, 118, 210, 118);
        $fpdf->Ln(5);
        $fpdf->Cell(180, 10, 'Net Amount: '.$net, 0,0, 'R');
        $fpdf->Line(0, 128, 210, 128);
        $fpdf->Output('Invoice.pdf', 'I');

        return response('Hello World', 200)
                        ->header('Content-Type', 'application/pdf');
            
            //return redirect('invoices');
            
    }

    public function print_invoice(FPDF $fpdf) {
        
        $print_in=DB::table('tblt_invoicedetail')->where('Inv_No',0000002)->get();
        $fpdf = new FPDF('L', 'mm', array(210, 154));
        $fpdf->AddPage();
        $fpdf->SetRightMargin(5);
        $fpdf->SetLeftMargin(5);
        $fpdf->SetFont('Courier', 'B', 28);
        $fpdf->Cell(190, 10, 'KOOLTECH ELECTRICALS', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 15);
        $fpdf->Cell(190, 10, 'No.18 B, Cross Street, Kandy', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 15);
        $fpdf->Cell(190, 10, 'Tel/Fax:081-2228666,Tel:077-3949282', 0, 0, 'C');

        //Receipt Type Name
        $fpdf->Ln(5);
        $fpdf->SetFont('Courier', 'B', 24);
        $fpdf->Cell(190, 10, 'Invoice', 0, 0, 'C');

        //end Receipt Type Name
        //$fpdf->Line(0, 38, 210, 38);

        //receipt body start
        $fpdf->Ln(10);
        $fpdf->SetFont('Courier', 'B', 12);
        $fpdf->Cell(100, 10, 'Invoice Mode: Mode', 0, 0, 'L');
        $fpdf->Ln(5);
        //$fpdf->Cell(100, 10, 'Payment Type: ', 0, 1, 'R');
        $fpdf->Cell(100, 10, 'Invoice No: 0000002', 0, 0, 'L');
        $fpdf->Cell(100, 10, 'Salesman: Salesmane Name', 0, 0, 'R');
        
        $fpdf->Ln(5);
        
        $fpdf->Cell(100, 10, 'Date: 2010-10-10', 0, 0, 'L');
        $fpdf->Cell(100, 10, 'Customer: Customer Name', 0, 0, 'R');
        $fpdf->Line(0, 58, 210, 58);
        $fpdf->Ln(10);
        $fpdf->Cell(15, 10, 'Count', 0, 0, 'L');
        $fpdf->Cell(40, 10, 'Code', 0, 0, 'L');
        $fpdf->Cell(60, 10, 'Description', 0, 0, 'L');
        $fpdf->Cell(25, 10, 'Price', 0, 0, 'L');
        $fpdf->Cell(20, 10, 'Qty', 0, 0, 'L');
        $fpdf->Cell(50, 10, 'Amount', 0, 1, 'L');
        $fpdf->Line(0, 68, 210, 68);
        $count=0;
        $net=0;
        foreach ($print_in as $print)
        {
            $count=$count+1;
            $net=$net+$print->Inv_Amount;
        $fpdf->Cell(15, 10, ''.$count, 0, 0, 'L');
        $fpdf->Cell(25, 10, ''.$print->Inv_ProCode, 0, 0, 'L');
        
        $fpdf->Cell(75, 10, ''.$print->Inv_Description, 0, 0, 'L');
        
        $fpdf->Cell(25, 10, ''.$print->Inv_GrossAmount, 0, 0, 'L');
        
        $fpdf->Cell(20, 10, ''.$print->Inv_Qty, 0, 0, 'L');
        
        $fpdf->Cell(50, 10, ''.$print->Inv_Amount, 0,0, 'L');
        $fpdf->Ln(5);
            if ($count>=5)
            {
                $fpdf->Line(0, 118, 210, 118);
                $fpdf->Ln(5);
                $fpdf->Cell(180, 10, 'Net Amount: ' . $net, 0, 0, 'R');
                $fpdf->Line(0, 128, 210, 128);
                $fpdf->Output('Invoice.pdf', 'I');

                return response('Hello World', 200)
                                ->header('Content-Type', 'application/pdf');
            }
        }
        //receipt body end
        //footer start
        //footer end
        //generate receipt pdf
        //$fpdf->Output('Invoice.pdf','D');
        $fpdf->Line(0, 118, 210, 118);
        $fpdf->Ln(5);
        $fpdf->Cell(180, 10, 'Net Amount: '.$net, 0,0, 'R');
        $fpdf->Line(0, 128, 210, 128);
        $fpdf->Output('Invoice.pdf', 'I');

        return response('Hello World', 200)
                        ->header('Content-Type', 'application/pdf');
    }

    public function getsih($code) {
        $stocks = DB::table('tblm_productdetail')->where('Pro_Code', $code)->value('Pro_Stock');
        if ($stocks == 0) {
            return 'SOLD OUT!!!';
        } else {
            return $stocks;
        }
    }

}
