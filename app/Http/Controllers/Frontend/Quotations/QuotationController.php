<?php

namespace App\Http\Controllers\Frontend\Quotations;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Quotations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;

class QuotationController extends Controller
{
    public function newquotation()
    {
        $temp_qt=DB::table('tbl_new_temporary_quotation')->get();
        $gross=0;
        $total_dis=0;
        $total_disper=0;
        $net=0;
        foreach ($temp_qt as $temp)
        {
            $gross=$gross+($temp->Price)*($temp->Qty);
            $total_dis=$total_dis+($temp->Dis_Val)*($temp->Qty);
            $total_disper=($total_dis*100)/$gross;
            $net=$gross-$total_dis;
            $invoicecode=$temp->Quotation_No;
            $discription=$temp->Product_Desc; 
        }


        $customers = DB::table('tblm_customer')->select('Cus_Code','Cus_Name')->get();

        $products = DB::table('tblm_product')->select('Pro_Code','Pro_Description')->get();

        $invoice_detail=DB::table('tblt_invoice')->select('Inv_No','Inv_NetAmount')->orderby('Inv_No','DESC')->first();

       
        return view('Frontend/InterfacesKT/Quotations/NewQuotation',['customers'=>$customers,'products'=>$products,'temp_qt'=>$temp_qt,'gross'=>$gross,'total_dis'=>$total_dis,'total_disper'=>$total_disper,'net'=>$net,'invoice_detail'=>$invoice_detail]);
    }
    
    
    public function addquotation(Quotations\AddQuotation $request)
    {
        if(isset($_POST['Add']))
        {
            $request->only(['invoiceid','cid','poroducts','qty']);
            $id = $request->input('QuotationNo');
            $customer = $request->input('CustomerID');
            $products = $request->input('products');
            $qty = $request->input('Quantity');
            $disper=$request->input('dis_per');
            $user=Auth::user()->name;
            $userid=Auth::user()->id;
            $product_data = DB::table('tblm_productdetail')->select('Pro_RetailPrice','Pro_DisPer','Pro_DisVal')->where('Pro_Code',$products)->first();
            $product_desc = DB::table('tblm_product')->where('Pro_Code',$products)->pluck('Pro_Description');
            $product_price=$product_data->Pro_RetailPrice;
            $product_dis_val=$product_price*($disper/100);
            $amount=($product_price-$product_dis_val)*$qty;
            
            $temp_invoice=DB::insert('insert into tbl_new_temporary_quotation (Quotation_No, Salesman, Salesman_ID, Customer_ID, Product_ID, Price, Dis_Per, Dis_Val, Qty, Bill_Dis_Val, Product_Desc) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$id, $user, $userid, $customer, $products, $product_price, $disper, $product_dis_val, $qty, $amount, $product_desc]);
            return redirect('newquotation');




        }

        elseif (isset($_POST['save']))
        {
            return 'save selected';
        }
    }
    
    public function dropqtitem(Quotations\DropQuotationItem $request)
    {
        $request->only('product_id');
        $pid=$request->input('product_id');
        DB::table('tbl_new_temporary_quotation')->where('Product_ID', '=', $pid)->delete();
        return redirect('newquotation');
    }
    
}
