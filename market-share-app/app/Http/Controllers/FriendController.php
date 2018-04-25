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
        $data = array('user_id'=>$user_id,'friend_id'=>$fid);
        DB::table('friends')->insert($data);
  }

  public function deleteFriend($fid){
        echo "Testing Unfriend";
        $user_id=Auth::user()->id;
       // $data = array('user_id'=>$user_id,'friend_id'=>$fid);
       //DB::table('friends')->delete($data);
        DB::table('friends')->where('user_id', '=', $user_id)->where('friend_id', '=', $fid)->delete();
  }

}