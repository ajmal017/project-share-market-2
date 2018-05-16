@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='/account'>Home</a>
        <a class = "sysoLink" href='/search'>Search</a>
        <a class = "sysoLink" href='/community'>Community</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='/landing'>Home</a>
        <a class = "sysoLink" href='/signin'>Login</a>
        <a class = "sysoLink" href='/signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='/about'>About</a>
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
                    <th>Profit</th>
                    <th>Equity</th>
                    <th>Purchases</th>
                    <th>Updated</th>
                    <th></th>
                </tr>
                <?php
                    //Top 10 Leaderboard
                    $users = DB::table('users')->get();
                    //SELECT * FROM users ORDER BY rating DESC LIMIT 10
                    $data = $users->sortByDesc('equity')->where('equity', '!=', 1000000)->take('10');
                    $user_id=Auth::id();
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
                ?>
                </table>
                <br/>
            </div>
            <div class="friends">
                <h1>Search for User</h1>
                <form id='searchForm'> 
                    <input id='searchUser' type='text' name='user_name' placeholder='Enter User Name'>
                    <input id='search' type='submit' value='Search'>
                    <?php
                        //Search User
                        $username = Request::get('user_name');
                        $userdata = DB::table('users')->where('name', 'like', '%'.$username.'%')->take(2)->get();
                        if (empty($username)){
                            echo "</form>";
                        }
                        elseif (count($userdata) == 0){
                            echo "<span id='searchErr'>User name does not exist</span>";
                            echo "</form>";
                        }
                        else {
                            echo "</form>";
                            echo "<table class='friendList'>";
                            echo "<tr id = 'tableHeader'>";
                            echo "<th>Name</th>";
                            echo "<th>Profit</th>";
                            echo "<th>Equity</th>";
                            echo "<th>Purchases</th>";
                            echo "<th>Updated</th>";
                            echo "<th></th>";
                            echo "</tr>";
                            $user_id=Auth::id();
                            foreach ($userdata as $line) {
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
                    <th>Profit</th>
                    <th>Equity</th>
                    <th>Purchases</th>
                    <th>Updated</th>
                    <th></th>
                </tr>
                <?php 
                    //List of Friends
                    $userid=Auth::id();
                    $friends=DB::table('users')->join('friends', 'users.id', '=', 'friends.friend_id')
                        ->select('users.*', 'friends.friend_id')->where('friends.user_id', $userid)->get();
                    $data=$friends->sortByDesc('equity')->where('equity', '!=', 1000000)->take(15);
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
                ?>
                </table>
            </div>
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection