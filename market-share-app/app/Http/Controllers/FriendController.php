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
        //$fid=Input::get('fid');
        $data = array('user_id'=>$user_id,'friend_id'=>$fid);
        DB::table('friends')->insert($data);
  }

}