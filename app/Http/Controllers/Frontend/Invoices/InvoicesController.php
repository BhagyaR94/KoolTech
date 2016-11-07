<?php

namespace App\Http\Controllers\Frontend\Invoices;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{

    public function index()
    {
        $user = DB::table('item')->where('SCAT', 'TLS')->pluck('CATEGORY','SCAT');

        foreach($user as $SCAT){
            echo($CATEGORY);
        }


    }

    public function invoices()
    {
        return view('frontend.InterfacesKT.Invoices');
    }

    public function AddNewInvoice()
    {
        return 'Helloooooooos';
    }
}
