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
    
    public function savereceipt(Receipts\SaveReceipt $request,FPDF $fpdf)
    {
        $receipt=$request->all();
        
        $paytype=$request->PayType;
        
        $customername = DB::table('tblm_customer')->where('Cus_Code',$request->CustomerID)->value('Cus_Name');
        
        if($paytype=="CH")
        {
            $fpdf=new FPDF('L','mm',array(210,154));
            $fpdf->AddPage();
            $fpdf->SetRightMargin(5);
            $fpdf->SetLeftMargin(5);
            $fpdf->SetFont('Courier', 'B', 28);
            $fpdf->Cell(190,10,'KOOLTECH ELECTRICALS',0,0,'C');
            $fpdf->Ln(6);
            $fpdf->SetFont('Courier', 'B', 15);
            $fpdf->Cell(190,10,'No.18 B, Cross Street, Kandy',0,0,'C');
            $fpdf->Ln(6);
            $fpdf->SetFont('Courier', 'B', 15);
            $fpdf->Cell(190,10,'Tel/Fax:081-2228666,Tel:077-3949282',0,0,'C');
            
            //Receipt Type Name
            $fpdf->Ln(5);
            $fpdf->SetFont('Courier', 'B', 24);
            $fpdf->Cell(190,10,'Receipt',0,0,'C');
            
            //end Receipt Type Name
            $fpdf->Line(0,38,210,38);

            //receipt body start
            $fpdf->Ln(10);
            $fpdf->SetFont('Courier', 'B', 12);
            $fpdf->Cell(100,10,'Receipt No: '.$request->ReceiptNo,0,0,'L');
            $fpdf->Cell(100,10,'Payment Type: '.$request->PayType,0,1,'R');
            $fpdf->Cell(100,10,'Receipt Purpose: '.$request->RecType,0,0,'L');
            $fpdf->Cell(100,10,'Customer: '.$request->CustomerID.' - '.$customername,0,0,'R');
            
            $fpdf->Ln(10);
            $fpdf->Cell(80,10,'Cheque No: '.$request->ChequeNo,0,0,'L');
            //$fpdf->Cell(80,10,'Cheque No: '.$request->ChequeNo,0,0,'L');
            $fpdf->Cell(120,10,'Bank: '.$request->Bank,0,1,'R');
            $fpdf->Cell(90,10,'Realized Date: '.$request->RealizeDate,0,0,'L');
            $fpdf->SetFont('Courier', 'B', 18);
            $fpdf->Cell(100,10,'Amount: Rs.'.$request->Amount.'/-',0,1,'R');
            $fpdf->Ln(10);
            $fpdf->SetFont('Courier', 'B', 14);
            $fpdf->Cell(200,10,'Remarks: '.$request->Remarks,0,0,'L');
            
            //receipt body end
            
            //footer start
            
            
            
            //footer end
            
            //generate receipt pdf
            //$fpdf->Output('Invoice.pdf','D');
            $fpdf->Output('Invoice.pdf','I');
            
            return response('Hello World', 200)
                  ->header('Content-Type', 'application/pdf');
        }
        
        else if($paytype=="CS")
        {
            return $paytype;
        }
        
    
    }
    
    public function getajax($code) {
        
        $customers = DB::table('tblm_customer')->where('Cus_Name','LIKE','%'.$code.'%')->pluck('Cus_Code');
        return $customers;
    }
    
    
}
