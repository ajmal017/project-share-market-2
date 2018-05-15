@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='account'>Home</a>
        <a class = "sysoLink" href='search'>Search</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='landing'>Home</a>
        <a class = "sysoLink" href='signin'>Login</a>
        <a class = "sysoLink" href='signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='about'>About</a>
@endsection

@section('content')
    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <script type='text/javascript'>
        function confReset(form) {
            if (confirm("Are you sure you want to reset the user's password?")) {
                form.submit();
            }
        }
        function confDelete(form) {
            if (confirm("Are you sure you want to delete this user and all associated records?")) {
                form.submit();
            }
        }
        function confAdjust(form) {
            var amount = prompt("Please enter new account balance:");
            if (amount != null) {
                GEBI('amount').value = amount;
                form.submit();
            }
        }
    </script>
    <?php
        use App\Http\Controllers\AdminController;
        if (!AdminController::isAdmin()) {
            // Redirect back to account page
            print "<script language='Javascript'>document.location.href='/account';</script>";
        } elseif(isset($_GET['reset'])) {
            $uid = $_GET['reset'];
            if (AdminController::resetPassword($uid)) {
                echo "Success! Password has been reset!";
            } else {
                echo "Error! Password reset failed!";
            }
        } elseif(isset($_GET['delete'])) {
            $uid = $_GET['delete'];
            if (AdminController::deleteUser($uid)) {
                echo "Success! User has been deleted!";
            } else {
                echo "Error! Unable to delete user!";
            }
        } elseif(isset($_GET['adjust'])) {
            $uid = $_GET['adjust'];
            $amount = $_GET['amount'];
            if (AdminController::adjustBalance($uid, $amount)) {
                echo "Success! User balance has been updated!";
            } else {
                echo "Error! Unable to update balance!";
            }
        }
    ?>
    <div class = "sysoBox sysoBoxFlex" id="commBox">
        <div class = "sysoContent sysoContent50">
            <h1 class = "sysoHeader1 sysoCenterText">Search for User</h1>
            <form> 
                <input class = "sysoInput" type='text' name='user_name' placeholder='Enter User Name'>
                <input class = "sysoInput" type='submit' value='Search'></form>
            <?php
                //Search User
                $username = Request::get('user_name');
                $userdata = DB::table('users')->where('name', 'like', '%'.$username.'%')->get();
                if (empty($username)){
                    /*Empty username detected*/
                }
                elseif (count($userdata) == 0){
                    echo "<span>No users found.</span>";
                }
                else {
                    $uid=null;
                    $uname=null;
                    $ubalance=0.00;
                    echo "<table class='friendList'>";
                    echo "<tr id = 'tableHeader'>";
                    echo "<th>User ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Email Address</th>";
                    echo "<th>Account Balance</th>";
                    echo "<th>Reset Password</th>";
                    echo "<th>Adjust Balance</th>";
                    echo "<th>Delete Account</th>";
                    echo "</tr>";
                    foreach ($userdata as $uline) {
                        $uid=($uline->id);
                        $uname=($uline->name);
                        $ubalance=($uline->account_balance);
                        $uemail=($uline->email);
                        echo "<tr>";
                        echo "<td>$uid</td>";
                        echo "<td>$uname</td>";
                        echo "<td>$uemail</td>";
                        echo "<td>$ubalance</td>";
                        echo "<td><form><input type='hidden' name='reset' value='$uid'><input class='adminButton' type='button' onClick='confReset(this.form);' value='Reset Password' /></form></td>";
                        echo "<td><form><input type='hidden' name='adjust' value='$uid'><input  type='hidden' id='amount' name='amount' value=0><input type='button' class='adminButton' onClick='confAdjust(this.form);' value='Adjust Balance' /></form></td>";
                        echo "<td><form><input type='hidden' name='delete' value='$uid'><input class='adminButton' type='button' onClick='confDelete(this.form);' value='Delete User' /></form></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection