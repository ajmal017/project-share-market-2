<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function account($userid){
        
        
        $json = DB::table('open_transactions')->where('user_id', '=', $userid)
            ->limit(10)
            ->get();
        $data = json_decode($json);
        
        return view('/account/')
            ->with('data', $data);   
    }
}
