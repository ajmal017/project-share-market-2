@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='../account'>Home</a>
        <a class = "sysoLink" id="../logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='../landing'>Home</a>
        <a class = "sysoLink" href='../signin'>Login</a>
        <a class = "sysoLink" href='../signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='../about'>About/FAQ</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->  

    <script type = "text/javascript" src = "{{ URL::to('/js/friend.js') }}"></script>

    <div class = "sysoBox sysoBoxFlex" id="commBox">
        <div class = "sysoContent sysoContent50">
            
            <div class="friends">
                <br/>
                <h1>Top 10 Users</h1>
                <table class="friendList">
                <tr id = "tableHeader">
                    <th>Name</th>
                    <th>Equity</th>
                    <th>Friend</th>
                </tr>

                <?php
                    //Top 10 Leaderboard
                    $users = DB::table('users')->get();
                    //SELECT * FROM users ORDER BY rating DESC LIMIT 10
                    $data = $users->sortByDesc('equity')->take('10');
                    $user_id=Auth::id();
                    $uid=null;
                    $name=null;
                    $balance=0.00;
                    foreach ($data as $line) {
                        $uid=($line->id);
                        $name=($line->name);
                        $balance=($line->equity);
                        echo "<tr>";
                        echo "<td>".$name."</td>";
                        echo "<td>".$balance."</td>";
                        $friendid = DB::table('friends')->where('user_id', $user_id)->where('friend_id', $uid)->get();
                        if (count($friendid) == 0){
                            echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Friend</button></td>";
                        }
                        else {
                            echo "<td><button name='friend' disabled>Friend</button></td>";
                        }
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
                
                <?php
                    //Search User
                    $username = Request::get('user_name');
                    $userdata = DB::table('users')->where('name', 'like', '%'.$username.'%')->take(2)->get();
                    if (empty($username)){
                        echo "</form>";
                    }
                    elseif (count($userdata) == 0){
                        echo "<span>User name does not exist</span>";
                        echo "</form>";
                    }
                    else {
                        echo "</form>";
                        echo "<table class='friendList'>";
                        echo "<tr id = 'tableHeader'>";
                        echo "<th>Name</th>";
                        echo "<th>Equity</th>";
                        echo "<th>Friend</th>";
                        echo "</tr>";
                        $user_id=Auth::id();
                        $uid=null;
                        $name=null;
                        $balance=0.00;
                        foreach ($userdata as $line) {
                            $uid=($line->id);
                            $name=($line->name);
                            $balance=($line->equity);
                            echo "<tr>";
                            echo "<td>".$name."</td>";
                            echo "<td>".$balance."</td>";
                            $friendid = DB::table('friends')->where('user_id', $user_id)->where('friend_id', $uid)->get();
                            if (count($friendid) == 0){
                                echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Friend</button></td>";
                            }
                            else {
                                echo "<td><button name='friend' disabled>Friend</button></td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                ?>
            </div>
        </div>

        <div class = "sysoContent sysoContent50">
            
            <div class="friends">
                <br/>
                <h1>Top 15 Friends</h1>
                <table class="friendList">
                <tr id = "tableHeader">
                    <th>Name</th>
                    <th>Equity</th>
                    <th>Unfriend</th>
                </tr>

                <?php 
                    //List of Friends
                    $userid=Auth::id();
                    $friends=DB::table('users')->join('friends', 'users.id', '=', 'friends.friend_id')->where('friends.user_id', $userid)->get();
                    $fdata=$friends->sortByDesc('equity')->take(15);

                    $name=null;
                    $balance=0.00;
                    foreach ($fdata as $fline) {
                        $fid=($fline->friend_id);
                        $name=($fline->name);
                        $balance=($fline->equity);
                        echo "<tr>";
                        echo "<td><a href='/account/'>".$name."</a></td>";
                        echo "<td>".$balance."</td>";
                        echo "<td><button name='friend' onclick='deleteAjax(".$fid.")'>Unfriend</button></td>";
                        echo "</tr>";
                    }
                ?>

                </table>
            </div>
        
        </div>

    </div>

    <!-- END OF CONTENT -->

@endsection