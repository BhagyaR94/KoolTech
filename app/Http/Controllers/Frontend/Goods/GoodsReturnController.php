<?php

namespace App\Http\Controllers\Frontend\Goods;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;

class GoodsReturnController extends Controller {

    public function goodsreturn() {
        $last_rec = DB::table('tblt_goodsreturn')->select('Gr_No')->orderby('Gr_No', 'DESC')->first();
        $received = DB::table('tblt_goodsreturndetail')->where('Gr_No','>',$last_rec->Gr_No)->get();
        return view('Frontend/InterfacesKT/Goods/GoodsReturn', ['last_rec' => $last_rec, 'received' => $received]);
        
    }

    public function getproduct($code) {

        $product = DB::table('tblm_product')->where('Pro_Code',$code)->get();
        //$product1 =DB::table('tblm_productdetail')->join('tblm_product','tblm_product.Pro_Code','=',$code)->select('tblm_product.Pro_Description','tblm_productdetail.Pro_RetailPrice','tblm_productdetail.ProStock')->get();
        foreach ($product as $pros) {
            $detail = '' . $pros->Pro_Description . ',' . $pros->Pro_BrCode.','.$pros->Pro_BrCode;
            return $detail;
        }
    }

    public function getsupplier($code) {

        $supplier = DB::table('tblm_supplier')->where('Sup_Code', $code)->value('Sup_Name');

        return $supplier;
    }
    
    public function savereturn($code)
    {
        $net_amount=0;
        $gross_amount=0;
        $tot_dis=0;
        
        $detail=DB::table('tblt_goodsreturndetail')->where('Gr_No',$code)->get();
        foreach($detail as $det)
        {
            $gross_amount=$net_amount+($det->Gr_Amount * $det->Gr_Qty);
            $tot_dis=$tot_dis+($det->Gr_Amount * ($det->Gr_DisPer)/100)*$det->Gr_Qty;
            $net_amount=$gross_amount-$tot_dis;
        }
        
        $report='Gross Amount:'.number_format($gross_amount, 2, '.',',').' Total Discounts:'.number_format($tot_dis, 2, '.',',').' Net Amount:'.number_format($net_amount, 2, '.',',');
        return $report;
    }

    public function returngood(Requests\Frontend\Goods\NewReturn $request) {
        $request->all();
        $grid = $request->ReturnNo;
        $grno = str_pad($grid, 8, '0', STR_PAD_LEFT);
        $outcode = 1;
        $procode = $request->ProductCode;
        $qty = $request->Qty;
        $rtnqty = 0;
        $cost = 0;
        $disper = $request->DisPer;
        $newcost = 0;
        $amount = $request->Amnt;
        $supcode = $request->SupCode;
        //echo $supcode;
        $insert = DB::insert('insert into tblt_goodsreturndetail (Gr_No,Gr_OutCode,Gr_Date,Gr_ProCode,Gr_Qty,Gr_RtnQty,Gr_Cost,Gr_DisPer,Gr_NewCost,Gr_Amount,Gr_SupCode) values (?,?,?,?,?,?,?,?,?,?,?) ', [$grno, $outcode, \Carbon\Carbon::now('Asia/Colombo'), $procode, $qty, $rtnqty, $cost, $disper, $newcost, $amount, $supcode]);
        //return $insert;
        return redirect('goodsreturn');
    }

    public function cleareturn(Requests\Frontend\Goods\DropReturn $request) {
        
        
        $request->all();
        $line = $request->temp_id;
        $grno = $request->grno;

        $delete = DB::table('tblt_goodsreturndetail')->where([
                    ['Gr_No', $grno],
                    ['Gr_LineNo', $line],
                ])->delete();

        return redirect('goodsreturn');
    }
    
    public function savereturngoods(Requests\Frontend\Goods\SaveReturn $request)
    {
        $SNo=$request->SaveNo;
        $outcode = 1;
        $net_amount=0;
        $gross_amount=0;
        $tot_dis=0;
        $supplier;
        $userid = Auth::user()->id;
        $detail=DB::table('tblt_goodsreturndetail')->where('Gr_No',$SNo)->get();
        foreach($detail as $det)
        {
            $supplier=$det->Gr_SupCode;
            $gross_amount=$net_amount+($det->Gr_Amount * $det->Gr_Qty);
            $tot_dis=$tot_dis+($det->Gr_Amount * ($det->Gr_DisPer)/100)*$det->Gr_Qty;
            $net_amount=$gross_amount-$tot_dis;
            $stock=$det->Gr_Qty;
            DB::table('tblm_productdetail')->where('Pro_Code',$det->Gr_ProCode)->decrement('Pro_Stock',number_format($stock, 2,'.',','));
        }
        $lastinvno=DB::table('tblt_invoice')->select('Inv_No')->orderby('Inv_No', 'DESC')->first();
        //$invno=$lastinvno+1;
        $insert = DB::insert('insert into tblt_goodsreturn (Gr_No,Gr_OutCode,Gr_Date,Gr_Time,Gr_SupCode,Gr_SupInvNo,Gr_Amount,Gr_UserCode) values (?,?,?,?,?,?,?,?) ', [$SNo, $outcode, \Carbon\Carbon::now('Asia/Colombo'), \Carbon\Carbon::now('Asia/Colombo'), $supplier, /*str_pad($invno, 8,'0',STR_PAD_LEFT)*/00000001, $net_amount,$userid]);
        
        return redirect('goodsreturn');
        
    }

}
