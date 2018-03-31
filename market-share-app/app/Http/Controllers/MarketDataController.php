<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;

class MarketDataController
{
    public function dailyStats($asx_code)
    {
        $url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=" . $asx_code . "&apikey=PEQIWLTYB0GPLMB8";
        $resp = $this->curlStocksStats($url);
        $resp = json_decode($resp);

        foreach ($resp as $key => $record) {
            var_dump($record);
            // var_dump(preg_replace(['/\./', '/ /'], ['_', '_'], strtolower($key)));
            // var_dump(preg_replace(['/\./', '/ /'], ['_', '_'], strtolower($key[$record])));
            // DB::table('asx_company_details')->insert([
            //         'created_at' => $record['Company name'],
            //         'last_refreshed' => $record['ASX code'],
            //         'last_refreshed' => $record['GICS industry group'],
            //         'asx_code' => $record['GICS industry group'],
            //         'date' => $record['GICS industry group'],
            //         'o pen' => $record['GICS industry group'],
            //         'high' => $record['GICS industry group'],
            //         'low' => $record['GICS industry group'],
            //         'close' => $record['GICS industry group'],
            //         'volume' => $record['GICS industry group']
            // ]);
        }
        die();
        return $resp;
    }

    public function intraDayStats($asx_code)
    {
        $url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=" . $asx_code . "&interval=1min&apikey=PEQIWLTYB0GPLMB8";
        $resp = $this->curlStocksStats($url);
        var_dump($resp);
        die();
        foreach ($resp as $key => $value) {
            var_dump($key);
            var_dump($value);
        }
        return $resp;
    }

    public function getCompanyDetails($asx)
    {
        $asx = strtoupper($asx);
        $users = DB::table('asx_company_details')->where('company_code', '=', $asx)->get();
        return $users;
    }

    public function curlStocksStats($url)
    {
        // Get cURL resource
        $curl = curl_init();
        // Set some options
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        // Send the request & save response to $resp
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/DSTRootCAX3.crt");

        $resp = curl_exec($curl);
        if (!curl_exec($curl)) {
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }

        // Close request to clear up some resources
        curl_close($curl);

        // Return the results
        return $resp;
    }
}