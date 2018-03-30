<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingsController extends Controller
{
    public function listing($symbol){
        
        return view('/pages/listing')->with('symbol', $symbol);
    }
}
