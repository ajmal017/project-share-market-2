<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;

class FriendController extends Controller
{
  
  public function insertFriend($fid){
        $user_id=Auth::user()->id;
        $data=array('user_id'=>$user_id,'friend_id'=>$fid);
        $check=DB::table('friends')->where('user_id', '=', $user_id)->where('friend_id', '=', $fid);
        if ($check->count() == 0) {
            DB::table('friends')->insert($data);
            return $data;
        }
        else{
            return null;
        }
  }

  public function deleteFriend($fid){
        $user_id=Auth::user()->id;
        DB::table('friends')->where('user_id', '=', $user_id)->where('friend_id', '=', $fid)->delete();
  }

  public function retAccount($fid){
        return view('/pages/account')->with('fid', $fid);
  }

  public function getfriends($id){
      //List of Friends
      $friends = DB::table('users')->join('friends', 'users.id', '=', 'friends.friend_id')->select('users.*', 'friends.friend_id')->where('friends.user_id', $id)->get()->sortByDesc('equity')->take(5);
      foreach($friends as $line) {
            $fid = ($line -> friend_id);
            $name = ($line -> name);
            $equity = ($line -> equity);
            $balance = ($line -> account_balance);
            $trans = DB:: table('closed_transactions') -> where('user_id', $fid) -> count('id');
            $updated = ($line -> updated_at);
            echo "<tr>";
            echo "<td><a href='/account/".$fid."' onclick='retAccount(".$fid.")'>".$name."</a></td>";
            echo "<td>"."$".number_format($equity, 2, '.', ',')."</td>";
            echo "<td>"."$".number_format($balance, 2, '.', ',')."</td>";
            echo "<td>".$trans."</td>";
            echo "<td>".date('d-m-Y', strtotime($updated))."</td>";
            echo "</tr>";
    }
  }

}