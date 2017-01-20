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

class QuickStockAdjController extends Controller
{
    public function index()
    {
        return view('frontend/InterfacesKT/Stocks/QuickStockAdj');
    }
}
