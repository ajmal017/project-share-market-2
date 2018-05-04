<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;

class LeaderboardController extends Controller
{

  public function searchFriend($data){
    echo "testing function";
    $user_id=Auth::id();
    $uid=null;
    $name=null;
    $balance=0.00;
    foreach ($data as $line) {
      $uid=($line->id);
      //$uid=($line->user_id);
      $name=($line->name);
      $balance=($line->account_balance);
      //$balance=($line->equity);
      $friendid = DB::table('friends')->where('user_id', $user_id)->where('friend_id', $uid)->get();
      echo "<tr>";
      echo "<td>".$name."</td>";
      echo "<td>".$balance."</td>";
      if (count($friendid) == 0){
        echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Friend</button></td>";
      }
      else {
        echo "<td><button name='friend' disabled>Friend</button></td>";
      }
      echo "</tr>";
    }  
  }
}