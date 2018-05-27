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
      $userid=Auth::id();
      $friends=DB::table('users')->join('friends', 'users.id', '=', 'friends.friend_id')
            ->select('users.*', 'friends.friend_id')->where('friends.user_id', $userid)->get();
      $data=$friends->sortByDesc('equity')->where('equity', '!=', 1000000)->take(5);
      foreach ($data as $line) {
            $fid=($line->friend_id);
            $name=($line->name);
            $equity=($line->equity);
            $balance=($line->account_balance);
            $profit=($equity-1000000);
            $trans = DB::table('closed_transactions')->where('user_id', $fid)->count('id');
            $updated=($line->updated_at);
            echo "<tr>";
            echo "<td><a href='/account/".$fid."' onclick='retAccount(".$fid.")'>".$name."</a></td>";
            echo "<td>"."$".number_format($profit,2,'.',',')."</td>";
            echo "<td>"."$".number_format($equity,2,'.',',')."</td>";                        
            echo "<td>".$trans."</td>";

            if (empty($updated)){
                  echo "<td></td>";
            } else{
                  echo "<td>".date('d-m-Y', strtotime($updated))."</td>";
            }

            echo "</tr>";
      }
  }

  public function getTopFriends(){
      //List of Friends
      $userid = Auth::id();
      $friends = DB::table('users')->join('friends', 'users.id', '=', 'friends.friend_id')->select('users.*', 'friends.friend_id')->where('friends.user_id', $userid)->get();
      $data = $friends->sortByDesc('equity')->where('equity', '!=', 1000000)->take(15);
      foreach ($data as $line) {
            $fid=($line->friend_id);
            $name=($line->name);
            $equity=($line->equity);
            $balance=($line->account_balance);
            $profit=($equity-1000000);
            $trans = DB::table('closed_transactions')->where('user_id', $fid)->count('id');
            $updated=($line->updated_at);
            echo "<tr>";
            echo "<td><a href='/account/".$fid."' onclick='retAccount(".$fid.")'>".$name."</a></td>";
            echo "<td>"."$".number_format($profit,2,'.',',')."</td>";
            echo "<td>"."$".number_format($equity,2,'.',',')."</td>";                        
            echo "<td>".$trans."</td>";

            if (empty($updated)){
                  echo "<td></td>";
            } else{
                  echo "<td>".date('d-m-Y', strtotime($updated))."</td>";
            }

            echo "<td id='unfriend'><button class = 'sysoButton' name='friend' onclick='deleteAjax(".$fid.")'>Unfriend</button></td>";
            echo "</tr>";
      }
  }

  public function getLeaderboard(){
      //Top 10 Leaderboard
      $users = DB::table('users')->get();
      //SELECT * FROM users ORDER BY rating DESC LIMIT 10
      $data = $users->sortByDesc('equity')->where('equity', '!=', 1000000)->take('10');
      $user_id = Auth::id();
      foreach ($data as $line) {
            $uid=($line->id);
            $name=($line->name);
            $equity=($line->equity);
            $balance=($line->account_balance);
            $profit=($equity-1000000);
            $trans = DB::table('closed_transactions')->where('user_id', $uid)->count('id');
            $updated=($line->updated_at);
            echo "<tr>";
            echo "<td>".$name."</td>";
            echo "<td>"."$".number_format($profit,2,'.',',')."</td>";
            echo "<td>"."$".number_format($equity,2,'.',',')."</td>";
            echo "<td>".$trans."</td>";
            
            if (empty($updated)){
                  echo "<td></td>";
            } else{
                  echo "<td>".date('d-m-Y', strtotime($updated))."</td>";
            }

            $friendid = DB::table('friends')->where('user_id', $user_id)->where('friend_id', $uid)->get();
            if (count($friendid) == 0){
                  echo "<td><button class = 'sysoButton' name='friend' onclick='addAjax(".$uid.")'>Friend</button></td>";
            }
            else {
                  echo "<td><button class = 'sysoButton' name='friend' disabled>Friend</button></td>";
            }
            echo "</tr>";
      }
  }

}