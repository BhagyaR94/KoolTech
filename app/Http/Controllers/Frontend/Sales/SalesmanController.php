<?php

namespace App\Http\Controllers\Frontend\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;
use Illuminate;

class SalesmanController extends Controller
{
   public function getSalesmanData()
   {
       $invoices=DB::table('tblt_invoice')->orderby('Inv_No','DESC')->paginate(5);
       $cinvoices=DB::table('tblt_cancelledinvoice')->orderby('Inv_No','DESC')->paginate(5);
       //$receipts=DB::table('tbla_receipts')->where('Inv_UserCode',$request->Salesman_No)->paginate(5);
       $goodsrtn=DB::table('tblt_goodsreturn')->orderby('Gr_No','DESC')->paginate(5);
       $goodsrcv=DB::table('tblt_goodsreceived')->orderby('Gr_No','DESC')->paginate(5);
       //$settles=DB::table('tblt_creditset')->where('Inv_UserCode',$request->Salesman_No)->paginate(5);
       //$rntchq=DB::table('tbla_returncheque')->where('Inv_UserCode',$request->Salesman_No)->paginate(5);
       return view('frontend/InterfacesKT/Sales/Salesman',['invoices'=>$invoices,'goodsrtn'=>$goodsrtn,'goodsrcv'=>$goodsrcv,'cinvoices'=>$cinvoices]);
   }
   
   public function getSales(Requests\Frontend\Sales\Salesman $request)
   {
       $invoices=DB::table('tblt_invoice')->where('Inv_AssCode',$request->Salesman_No)->orderby('Inv_No','DESC')->paginate(5);
       $cinvoices=DB::table('tblt_cancelledinvoice')->where('Inv_AssCode',$request->Salesman_No)->orderby('Inv_No','DESC')->paginate(5);
       //$receipts=DB::table('tbla_receipts')->where('Inv_UserCode',$request->Salesman_No)->paginate(5);
       $goodsrtn=DB::table('tblt_goodsreturn')->where('Gr_UserCode',$request->Salesman_No)->orderby('Gr_No','DESC')->paginate(5);
       $goodsrcv=DB::table('tblt_goodsreceived')->where('Gr_UserCode',$request->Salesman_No)->orderby('Gr_No','DESC')->paginate(5);
       //$settles=DB::table('tblt_creditset')->where('Inv_UserCode',$request->Salesman_No)->paginate(5);
       //$rntchq=DB::table('tbla_returncheque')->where('Inv_UserCode',$request->Salesman_No)->paginate(5);
       return view('frontend/InterfacesKT/Sales/Salesman',['invoices'=>$invoices,'goodsrtn'=>$goodsrtn,'goodsrcv'=>$goodsrcv,'cinvoices'=>$cinvoices]);
   }
}
