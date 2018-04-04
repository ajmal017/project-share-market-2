<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use Carbon\Carbon;

class ListingsController extends Controller
{
    public function listing($asx){
        
        $asx = strtoupper($asx);
        $json = DB::table('asx_company_details')->where('company_code', '=', $asx)
            ->limit(10)
            ->get();
        $data = json_decode($json);
        
        return view('/pages/listing')
            ->with('symbol', $asx)
            ->with('data', $data);   

        
    }
}
