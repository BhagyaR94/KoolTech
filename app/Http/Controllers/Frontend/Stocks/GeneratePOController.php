<?php

namespace App\Http\Controllers\Frontend\Stocks;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\Invoices\AddInvoice;
use App\Http\Requests\Frontend\Invoices\DropInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;
use Illuminate;

class GeneratePOController extends Controller
{
    public function index()
    {
        $poitems=DB::table('tblm_productdetail')->join('tblm_product','tblm_productdetail.Pro_Stock','=','tblm_product.Pro_ReorderQty')->paginate(20);
        
        return view('frontend.InterfacesKT.Stocks.GeneratePO',['poitems'=>$poitems]);
    }
}
