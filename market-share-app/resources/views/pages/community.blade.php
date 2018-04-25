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
                        echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Friend</button></td>";
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
                                echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Friend</button></td>";
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
                            echo "<td><button name='friend' onclick='deleteAjax(".$fid.")'>Unfriend</button></td>";
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