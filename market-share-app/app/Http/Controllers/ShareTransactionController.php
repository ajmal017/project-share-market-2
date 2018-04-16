<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\OpenTransactions;
use App\Models\ClosedTransactions;
use App\Http\Requests ;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ShareTransactionController extends Controller
{
    public function balance()
    {
        
        $this->buyShares('test','35',100, false);
        $balance = \Auth::user()->account_balance;
        return view('/pages/testing/buy-shares')->with('balance', $balance);
    }

    public static function buyShares($stockCode,$price, $quantity)
    {
        $error = null;
        $user = Users::find(\Auth::user()->id);
        if($user == null)
        {
            //TODO: user not logged in
        }
        $totalPrice = ($price * $quantity) + $this->buyingCommission();
        if($totalPrice > $user->account_balance)
        {
            //TODO: user cannot afford to buy these shares
        }
        $user->account_balance -= $totalPrice;
        $user->save();
        //$openTransaction = 
        DB::table('open_transactions')->insert([
            'user_id' => $user,
            'is_short_selling' => 0,
            'asx_code' => $stockCode,
            'date_opened' => Carbon::now(),
            'purchase_price' => $price,
            'quantity' => $quantity,
            
            'buying_commission' => 0 // need to add this in
        ]);
        return true;
        

    }

    public static function buyingCommission($price, $quantiy)
    {
        //TODO read settings and apply buying commission
        return 20; 
    }

}
