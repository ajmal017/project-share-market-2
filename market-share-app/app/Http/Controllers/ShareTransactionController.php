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
use App\Http\Controllers\ListingsController;

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
        
        if($totalPrice > \Auth::user()->account_balance)
        {
            return false;
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

    public static function sellShares($asxcode) {
        $price = ListingsController::getCurrentPrice($asxcode);
        $user = Users::find(\Auth::user()->id);
        # calculate sell price
        
        $json = DB::table('open_transactions')
            ->where('user_id', '=', $user->id)
            ->where('asx_code', '=', $asxcode)
            ->sum('quantity');
            
        $data = json_decode($json);
        $quantity = $data['quantity'];
        
        $commission = ShareTransactionController::sellingCommission($price, $quantity);
        $sellprice = ($price*$quantity)-$commission;
        
        # delete from open transactions
        $json = DB::table('open_transactions')
            ->where('user_id', '=', $user->id)
            ->where('asx_code', '=', $asxcode)
            ->delete();
        
        // TO-DO insert into closed_transactions
        
        # update account balance
        ShareTransactionController::adjustBalance($user->id, $sellprice);

    }

    public static function buyingCommission($price, $quantity)
    {
        $fixed = 50;
        $percentage = 0.01; //1% commission on buying
        return ($fixed + ($percentage*$price*$quantity));
    }

    public static function sellingCommission($price, $quantity) {
        $fixed = 50;
        $percentage = 0.0025; //0.25% commission on selling
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