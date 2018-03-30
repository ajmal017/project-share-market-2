<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketDataController {
    public function save()
    {
      // Get cURL resource
      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=CWN&interval=1min&apikey=PEQIWLTYB0GPLMB8"
      ));
      // Send the request & save response to $resp
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/DSTRootCAX3.crt");

      $resp = curl_exec($curl);
      if(!curl_exec($curl)){
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
      }

      // Close request to clear up some resources
      curl_close($curl);
      return $resp;
    }

}