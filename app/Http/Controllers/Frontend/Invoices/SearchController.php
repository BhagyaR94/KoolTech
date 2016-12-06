<?php

namespace App\Http\Controllers\Frontend\Invoices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchview()
{
    return view('frontend/InterfacesKT/SearchResult');
}

    public function searchUser(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('tblm_customer')
            ->where('Cus_Code', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->first_name.' '.$query->last_name ];
        }
        return Response::json($results);
    }
}
