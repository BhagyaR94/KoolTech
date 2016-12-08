<?php

namespace App\Http\Controllers\Frontend\Invoices;



use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;


class InvoiceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoices()
    {
        $temp_inv=DB::table('tbl_new_temporary_invoice')->get();
        $gross=0;
        $total_dis=0;
        $total_disper=0;
        $net=0;
        foreach ($temp_inv as $temp)
        {
            $gross=$gross+($temp->Price)*($temp->Qty);
            $total_dis=$total_dis+($temp->Dis_Val)*($temp->Qty);
            $total_disper=($total_dis*100)/$gross;
            $net=$gross-$total_dis;
            $invoicecode=$temp->Invoice_No;
            $discription=$temp->Product_Desc; 
        }


        $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();

        $products = DB::table('tblm_product')->select('Pro_Code','Pro_Description')->get();

        $invoice_detail=DB::table('tblt_invoice')->select('Inv_No','Inv_NetAmount')->orderby('Inv_No','DESC')->first();

       return view('frontend/InterfacesKT/Invoices',['customers'=>$customers,'products'=>$products,'temp_inv'=>$temp_inv,'gross'=>$gross,'total_dis'=>$total_dis,'total_disper'=>$total_disper,'net'=>$net,'invoice_detail'=>$invoice_detail]);
    }

    /**
     *
     */
    
    /**
     * @param Requests\AddInvoice $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function feed_records(AddInvoice $request)
    {

        if(isset($_POST['Add']))
        {
            $request->only(['invoiceid','cid','poroducts','qty']);
            $id = $request->input('invoiceid');
            $customer = $request->input('cid');
            $products = $request->input('products');
            $qty = $request->input('qty');
            $disper=$request->input('dis_per');
            $user=Auth::user()->name;
            $userid=Auth::user()->id;
            $product_data = DB::table('tblm_productdetail')->select('Pro_RetailPrice','Pro_DisPer','Pro_DisVal')->where('Pro_Code',$products)->first();
            $product_desc = DB::table('tblm_product')->where('Pro_Code',$products)->pluck('Pro_Description');
            $product_price=$product_data->Pro_RetailPrice;
            $product_dis_val=$product_price*($disper/100);
            $amount=($product_price-$product_dis_val)*$qty;
            
            $temp_invoice=DB::insert('insert into tbl_new_temporary_invoice (Invoice_No, Salesman, Salesman_ID, Customer_ID, Product_ID, Price, Dis_Per, Dis_Val, Qty, Bill_Dis_Val, Product_Desc) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$id, $user, $userid, $customer, $products, $product_price, $disper, $product_dis_val, $qty, $amount, $product_desc]);
            return redirect('invoices');




        }

        elseif (isset($_POST['save']))
        {
            return 'save selected';
        }

    }
    
    public function drop_records(DropInvoice $request)
    {
        
        $request->only('product_id');
        $pid=$request->input('product_id');
        DB::table('tbl_new_temporary_invoice')->where('Product_ID', '=', $pid)->delete();
        return redirect('invoices');
    }
    
    public function save_records($invoiceid,FPDF $fpdf)
    {
        
        $temp_inv=DB::table('tbl_new_temporary_invoice')->where('Invoice_No',$invoiceid)->get();
        $gross=0;
        $total_dis=0;
        $total_disper=0;
        $net=0;
        $customer='';
        $user=Auth::user()->name;
        $userid=Auth::user()->id;
        
        
        foreach ($temp_inv as $temp)
        {
            $customer=$temp->Customer_ID;
            $gross=$gross+($temp->Price)*($temp->Qty);
            $total_dis=$total_dis+($temp->Dis_Val)*($temp->Qty);
            $total_disper=($total_dis*100)/$gross;
            $net=$gross-$total_dis;
        }
        
        $invoice=DB::insert('insert into tblt_invoice(Inv_No, Inv_OutCode, Inv_Mode, Inv_Date, Inv_Time, Inv_UserCode, Inv_AssCode, Inv_CusCode, Inv_GrossAmount, Inv_BillDiscount, Inv_NetAmount, Inv_CreditSale) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[$invoiceid,1,'C',  \Carbon\Carbon::now(),\Carbon\Carbon::now(),$user,$userid,$customer,$gross,$total_dis,$net,$net]);
        
        
    /*$fpdf->AddPage();
    $fpdf->SetFont('Courier', 'B', 18);
    $fpdf->Cell(50, 25, 'Hello World! BHAGYA RATHNAYAKE');
    
    
    $fpdf->Output('Invoice.pdf','D');*/
    
    }
    
    
public function genpdf(FPDF $fpdf,$inid) {

    
    $fpdf->AddPage();
    $fpdf->SetFont('Courier', 'B', 18);
    $fpdf->Cell(50, 25, 'Hello World! BHAGYA RATHNAYAKE'.$inid);
    header("Content-type: application/pdf");
    $fpdf->Output('Invoice.pdf','D');

}

}
