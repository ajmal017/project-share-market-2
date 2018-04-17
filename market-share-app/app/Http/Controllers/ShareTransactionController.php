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
use Illuminate\Support\Facades\DB;

class ShareTransactionController extends Controller
{
    /*public function balance()
    {
        
        $this->buyShares('test','35',100, false);
        $balance = \Auth::user()->account_balance;
        return view('/pages/testing/buy-shares')->with('balance', $balance);
    }*/

    public static function buyShares($stockCode,$price, $quantity)
    {
        $error = null;
        $user = Users::find(\Auth::user()->id);
        if($user == null)
        {
            //TODO: user not logged in
        }
        $commission = ShareTransactionController::buyingCommission($price, $quantity);
        $totalPrice = ($price * $quantity) + $commission;
        //$this->buyingCommission();
        if($totalPrice > \Auth::user()->account_balance)
        {
            //TODO: user cannot afford to buy these shares
        }
        ShareTransactionController::adjustBalance($user->id,$totalPrice*-1);
        $user->save();
        //$openTransaction = 
        DB::table('open_transactions')->insert([
            'user_id' => $user->id,
            'is_short_selling' => 0,
            'asx_code' => $stockCode,
            'date_opened' => Carbon::now(),
            'purchase_price' => $price,
            'quantity' => $quantity,
            'buying_commission' => $commission // need to add this in
        ]);
        return true;
        

    }

    public static function buyingCommission($price, $quantity)
    {
        $fixed = 50;
        $percentage = 0.0025; //0.25% commission on sales
        return ($fixed + ($percentage*$price*$quantity));
    }

    public static function adjustBalance($userid, $amount) {
        // must pass through a negative amount for a deduction (buying)
        // positive amount for a credit (selling)
        $currbalance = \Auth::user()->account_balance;
        $newbalance = $currbalance + $amount;
        DB::table('users')
            ->where('id',$userid)
            ->update(['account_balance' => $newbalance]);
    }
}
