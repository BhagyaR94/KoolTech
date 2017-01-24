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
        
        $products = DB::table('tblm_product')->select('Pro_Code','Pro_Description')->get();

        $qt_cr = DB::table('tblt_quotation')->where('Qut_Mode', 'D')->select('Qut_No')->orderby('Qut_No', 'DESC')->first();

        $qt_cs = DB::table('tblt_quotation')->where('Qut_Mode', 'C')->select('Qut_No')->orderby('Qut_No', 'DESC')->first();
       
        return view('Frontend/InterfacesKT/Quotations/NewQuotation',['products'=>$products,'temp_qt'=>$temp_qt,'gross'=>$gross,'total_dis'=>$total_dis,'total_disper'=>$total_disper,'net'=>$net,'qt_cr'=>$qt_cr,'qt_cs'=>$qt_cs]);
    }
    
    
    public function addquotation(Quotations\AddQuotation $request)
    {
        
            $id = $request->QuotationNo;
            $mode =$request->PayType;
            $products = $request->products;
            $qty = $request->Quantity;
            $disper=$request->dis_per;
            $user=Auth::user()->name;
            $userid=Auth::user()->id;
            $product_data = DB::table('tblm_productdetail')->select('Pro_RetailPrice','Pro_DisPer','Pro_DisVal')->where('Pro_Code',$products)->first();
            $product_desc = DB::table('tblm_product')->where('Pro_Code',$products)->pluck('Pro_Description');
            $product_price=$product_data->Pro_RetailPrice;
            $product_dis_val=$product_price*($disper/100);
            $amount=($product_price-$product_dis_val)*$qty;
            
            $temp_invoice=DB::insert('insert into tbl_new_temporary_quotation (Quotation_No, Salesman, Salesman_ID,Product_ID, Price, Dis_Per, Dis_Val, Qty, Bill_Dis_Val, Product_Desc) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$id, $user, $userid, $products, $product_price, $disper, $product_dis_val, $qty, $amount, $product_desc]);
            return redirect('newquotation');

    }
    
    public function dropqtitem(Quotations\DropQuotationItem $request)
    {
        echo $tempid=$request->input('temp_id');
        echo $proid=$request->pro_id;
    
        /*$request->only('temp_id');
        $tempid=$request->input('temp_id');
        DB::table('tbl_new_temporary_quotation')->where('temp_id', $tempid)->delete();
        return redirect('newquotation');*/
    }
    
}
