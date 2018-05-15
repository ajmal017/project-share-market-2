<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    public static function isAdmin() {
        return (Auth::user()->email == 'admin@gmail.com');
    }
    

    public static function resetPassword($userid) {
        // admin function to reset a password
        if (!AdminController::isAdmin()) {
            return false;
        }

        // checks if user exists
        $check = DB::select('select * from users where id = :id', ['id' => $userid]);
        if (empty($check)) {
            return false;
        }
        
            
        $default = 'secret';
        //$password = Hash::make($data['password']);
        $password = bcrypt($default);
        try {
            DB::table('users')
                ->where('id',$userid)
                ->update(['password' => $password]);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public static function adjustBalance($userid, $amount) {
        // admin function to update a user's account balance
        if (!AdminController::isAdmin() || !is_numeric($amount)) {
            return false;
        }
        try {
            DB::table('users')
                ->where('id',$userid)
                ->update(['account_balance' => $amount]);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public static function deleteUser($userid) {
        // admin function to delete a user, their open transactions and friends
        if (!AdminController::isAdmin()) {
            return false;
        }
        try {
            DB::table('open_transactions')
                ->where('user_id', '=', $userid)
                ->delete();
            DB::table('users')
                ->where('id',$userid)
                ->delete();
            DB::table('friends')
                ->where('user_id',$userid)
                ->delete();
            DB::table('friends')
                ->where('friend_id',$userid)
                ->delete();            
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
