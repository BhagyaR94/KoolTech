<?php

namespace App\Http\Controllers\Frontend\ReturnedCheques;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Frontend\ReturnedCheques;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF;

class ReturnedChequesController extends Controller {

    public function returnedcheques() {
        return view('Frontend/InterfacesKT/ReturnedCheques/ReturnedCheques');
    }

    public function getreturnedcheqedetails($code) {
        $bnk = DB::table('tbla_receipts')->where('Rcp_ChqNo', $code)->value('Rcp_BnkCode');
        $cus = DB::table('tbla_receipts')->where('Rcp_ChqNo', $code)->value('Rcp_CusCode');
        $amt = DB::table('tbla_receipts')->where('Rcp_ChqNo', $code)->value('Rcp_Amount');
        $retchqdata = $bnk . ',' . $cus . ',' . $amt;
        return $retchqdata;
    }

    public function reportchequesave(ReturnedCheques\ReportCheque $request) {
        $rc = $request->all();
        return $rc;
    }

}
