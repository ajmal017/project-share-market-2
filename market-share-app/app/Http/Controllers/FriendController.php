<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
  function insertFriend($friend_id){
    $user_id=Auth::user()->id;
    $data = array('user_id'=>$user_id,'friend_id'=>$friend_id);
    DB::table('friends')->insert($data);
  }

}