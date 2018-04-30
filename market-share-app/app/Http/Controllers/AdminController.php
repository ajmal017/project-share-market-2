<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public static function checkAdmin() {
        // TO-DO function to confirm logged in user has admin privleges
    }

    public static function resetPassword($userid) {
        // admin function to reset a password
        $default = 'secret';
        $password = Hash::make($data['password']);
        try {
            DB::table('users')
                ->where('id',$userid)
                ->update(['password' => $password]);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public static function updateBalance($userid, $amount) {
        // admin function to update a user's account balance
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
