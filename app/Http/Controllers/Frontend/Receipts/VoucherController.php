<?php

namespace App\Http\Controllers\Frontend\Receipts;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;
use Illuminate;

class VoucherController extends Controller
{
    public function index()
    {
        $customers=DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();
        return view('frontend.InterfacesKT.Receipts.Vouchers',['customers'=>$customers]);
    }
    
    public function addvoucher(Requests\Frontend\Receipts\Voucher $request)
    {
        $vno=$request->VoucherNo;
        $mode=$request->PayType;
        $amnt=$request->Amount;
        $cus=$request->CustomerID;
        $user = Auth::user()->name;
        $userid = Auth::user()->id;
        
        //Bill Starts Here    

        $fpdf = new FPDF('L', 'mm', array(210, 154));
        $fpdf->AddPage();
        $fpdf->SetRightMargin(5);
        $fpdf->SetLeftMargin(5);
        $fpdf->Image('F:\Out Sourcing\KoolTech\app\Http\Controllers\Frontend\Invoices\KE.jpg', 10, 10, -150);

        $fpdf->SetFont('Courier', 'B', 9);
        $fpdf->Cell(190, 10, 'Date & Time :' . \Carbon\Carbon::now('Asia/Colombo'), 0, 0, 'R');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 28);
        $fpdf->Cell(190, 10, 'KOOLTECH ELECTRICALS', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 9);
        $fpdf->Cell(190, 10, 'Refrigeration, Air conditioning, Auto air conditioning Electrical Compressed air, Steam Spares & Accessories', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 15);
        $fpdf->Cell(190, 10, 'No.18 B, Cross Street, Kandy', 0, 0, 'C');
        $fpdf->Ln(6);
        $fpdf->SetFont('Courier', 'B', 15);
        $fpdf->Cell(190, 10, 'Tel/Fax:081-2228666,Tel:077-3949282', 0, 0, 'C');
      
        //Receipt Type Name
        $fpdf->Ln(5);
        $fpdf->SetFont('Courier', 'B', 24);
        $fpdf->Cell(190, 10, 'VOUCHER', 0, 0, 'C');

        //end Receipt Type Name
        //$fpdf->Line(0, 38, 210, 38);
        //receipt body start
        $fpdf->Ln(10);
        $fpdf->SetFont('Courier', 'B', 12);
        $fpdf->Cell(100, 10, 'Invoice Mode: ' . $mode, 0, 0, 'L');
        $fpdf->Ln(5);
        //$fpdf->Cell(100, 10, 'Payment Type: ', 0, 1, 'R');
        $fpdf->Cell(100, 10, 'Voucher No: ' . $vno, 0, 0, 'L');
        $fpdf->Cell(100, 10, 'Salesman: ' . $userid . ' : ' . $user, 0, 0, 'R');

        $fpdf->Ln(5);

        $fpdf->Cell(100, 10, 'Date: '.\Carbon\Carbon::now('Asia/Colombo'), 0, 0, 'L');
        $fpdf->Cell(100, 10, 'Customer: ' . $cus, 0, 0, 'R');
        $fpdf->Ln(5);
        $fpdf->Ln(10);
        $fpdf->Cell(15, 10, 'Count', 0, 0, 'L');
        $fpdf->Cell(40, 10, 'Code', 0, 0, 'L');
        $fpdf->Cell(60, 10, 'Description', 0, 0, 'L');
        $fpdf->Cell(25, 10, 'Price', 0, 0, 'L');
        $fpdf->Cell(20, 10, 'Qty', 0, 0, 'L');
        $fpdf->Cell(50, 10, 'Amount', 0, 1, 'L');
        $fpdf->Line(0, 68, 210, 68);
       $fpdf->Output('Voucher'.$vno.'.pdf', 'D');

       
       return response()->route('invoices')->header('Content-Type', 'application/pdf');
       
        //receipt body end
        //footer start
        //footer end
        //generate receipt pdf
        //$fpdf->Output('Invoice.pdf','D');
        //return redirect('invoices');
        
        
    }
}
