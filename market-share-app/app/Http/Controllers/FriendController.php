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
            //return redirect()->to('/community'); 
            //return back();
            //return view('community');
        }
        else{
            return null;
        }
  }

  public function deleteFriend($fid){
        $user_id=Auth::user()->id;
        DB::table('friends')->where('user_id', '=', $user_id)->where('friend_id', '=', $fid)->delete();
  }

}