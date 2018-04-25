@extends('layouts/main-template')

@section('content')

    <?php
    /*    function insertFriend($friend_id){
            $user_id=Auth::id();
            $data = array('user_id'=>$user_id,'friend_id'=>$friend_id);
            DB::table('friends')->insert($data);
        }*/
    ?>

   <!-- <script type = "text/javascript">
        function insertFriend(friendid){
            var fid=friendid;
            var uid={{Auth::id()}};
            var sql = "INSERT INTO friends (user_id, friend_id) VALUES (uid, fid)";
        }
    </script>-->

    <script type = "text/javascript">
    
        function callAjax(fid){
            alert("testing123");
            $.ajax({
                //url: '/community',
                url: "/community/" + $(fid),
                type: 'get',
                success: function() {
                    console.log("Valueadded");
                }
            });
        }
    </script>

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    <div class = "sysoBox sysoBoxFlex" id="commBox">
        <div class = "sysoContent sysoContent50">
            
            <div class="friends">
                <br/>
                <h1>Top 10</h1>
                <table class="friendList">
                <tr id = "tableHeader">
                    <th>Name</th>
                    <th>Total Worth</th>
                    <th>Friend</th>
                </tr>

                <?php
                    //Top 10 Leaderboard
                    $users = DB::table('users')->get();
                    //SELECT * FROM articles ORDER BY rating DESC LIMIT 10
                    $data = $users->sortByDesc('account_balance')->take('10');
                    $name=null;
                    $balance=0.00;
                    foreach ($data as $line) {
                        $uid=($line->id);
                        $name=($line->name);
                        $balance=($line->account_balance);
                        echo "<tr>";
                        echo "<td>".$name."</td>";
                        echo "<td>".$balance."</td>";
                        //echo "<td><button name='friend' onclick='".route('comm.friend', $uid)."'>Friend</button></td>";
                        echo "<td><button name='friend' onclick='callAjax()'>Friend</button></td>";
                        //echo "<form method='get'><td><input type='submit' name='insFriend[$uid]' value='Friend'/></td></form>";
                        /*<form name="myForm">
                            <input type="hidden" id="bla" name="bla" value="<?php echo $value['bla']; ?>">
                            <input type="button" onclick="ajaxFunction(<?php echo $value['id']; ?>)" value="Speichern">
                            </form>*/
                        echo "</tr>";
                        }
                ?>

                </table>
                <br/>
            </div>
            
            <div class="friends">
                <h1>Search for User</h1>
                <form> 
                    <input type='text' name='user_name' placeholder='Enter User Name'>
                    <input type='submit' value='Search'>
                </form>
                <table class="friendList">
                <tr id = "tableHeader">
                    <th>Name</th>
                    <th>Total Worth</th>
                    <th>Friend</th>
                </tr>
                
                <?php
                    //Search User
                    $username = Request::get('user_name');
                    if ($username == null){
                        echo "<tr></tr>";
                    }
                    else {
                        $userdata = DB::table('users')->where('name', 'like', '%'.$username.'%')->get();
                        $uid=null;
                        $uname=null;
                        $ubalance=0.00;
                            foreach ($userdata as $uline) {
                                $uid=($uline->id);
                                $uname=($uline->name);
                                $ubalance=($uline->account_balance);
                                echo "<tr>";
                                echo "<td>".$uname."</td>";
                                echo "<td>".$ubalance."</td>";
                                echo "<td><button name='friend' onclick='".insertFriend($uid)."'>Friend</button></td>";
                                echo "</tr>";
                            }
                    }
                ?>

                </table>
            </div>

        </div>

        <div class = "sysoContent sysoContent50">
            
            <div class="friends">
                <br/>
                <h1>Friends</h1>
                <table class="friendList">
                <tr id = "tableHeader">
                    <th>Name</th>
                    <th>Total Worth</th>
                    <th>Unfriend</th>
                </tr>

                <?php 
                    //List of Friends
                    $user_id=Auth::id();
                    $friends=DB::table('friends')->where('user_id', $user_id)->get();
                    $name=null;
                    $balance=0.00;
                    foreach ($friends as $f) {
                        $fid=($f->friend_id);
                        $data=DB::table('users')->where('id', $fid)->get();
                        foreach ($data as $line) {
                            $name=($line->name);
                            $balance=($line->account_balance);
                            echo "<tr>";
                            echo "<td>".$name."</td>";
                            echo "<td>".$balance."</td>";
                            echo "<td><button name='friend'>Unfriend</button></td>";
                            echo "</tr>";
                        }
                    }
                ?>

                </table>
            </div>
        
        </div>

    </div>

    <!-- END OF CONTENT -->

@endsection