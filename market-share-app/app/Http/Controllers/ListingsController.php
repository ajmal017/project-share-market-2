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
        
        $currentprice = $this->getCurrentPrice($asx);


        return view('/pages/listing')
            ->with('symbol', $asx)
            ->with('data', $data)
            ->with('price',$currentprice);   
    }

    public static function getCurrentPrice($code) {
        $url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=" . $code . ".ax&interval=1min&apikey=PEQIWLTYB0GPLMB8";
        $call = MarketDataController::curlStocksStats($url);
        $asxdata = json_decode($call, true);
        $name = 'Time Series (1min)';
        $name2 = '4. close';
        $array = $asxdata[$name];
        $keys = array_keys($array);
        $newarr = $array[$keys[0]];
        return $newarr[$name2];
    }
}
