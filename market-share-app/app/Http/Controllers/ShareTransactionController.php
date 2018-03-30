<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\OpenTransactions;
use App\Models\ClosedTransactions;

class ShareTransactionController extends Controller
{
    public function balance()
    {
        
        $this->buyShares('test','35',100, false);
        $balance = \Auth::user()->account_balance;
        return view('/pages/testing/buy-shares')->with('balance', $balance);
    }

    public function buyShares($stockCode,$price, $quantity, $isShortSelling)
    {
        $error = null;
        $user = Users::find(\Auth::user()->id);
        if($user == null)
        {
            //TODO: user not logged in
        }
        $totalPrice = ($price * $quantity) + $this->$buyingCommission;
        if($totalPrice > $user->account_balance)
        {
            //TODO: user cannot afford to buy these shares
        }
        $user->account_balance -= $totalPrice;
        $user->save();
        $openTransaction = 

        

    }

    public function buyingCommission($price, $quantiy)
    {
        //TODO read settings and apply buying commission
        return 20; 
    }
}
