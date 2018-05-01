@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <script type='text/javascript'>
        function confReset(form) {
            if (confirm("Are you sure you want to reset the user's password?")) {
                form.submit();
            }
        }
    </script>
    <?php
        use Http\Controllers\AdminController;
        if (!isAdmin()) {
            echo "You are not admin!!!";
        } else {
            echo "You are admin";
        }
        // if user not admin, redirect to another page
        // if post 1
        // if post 2
        // if post 3
    ?>
    
    <div class = "sysoBox sysoBoxFlex" id="commBox">
        <div class = "sysoContent sysoContent50">
    
        
            <h1>Search for User</h1>
            <form> 
                <input type='text' name='user_name' placeholder='Enter User Name'>
                <input type='submit' value='Search'>
            
            <?php
                //Search User
                $username = Request::get('user_name');
                $userdata = DB::table('users')->where('name', 'like', '%'.$username.'%')->get();
                if (empty($username)){
                    
                }
                elseif (count($userdata) == 0){
                    echo "<span>User name does not exist</span>";
                    
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
                        echo "<td><form><input type='hidden' name='uid' value='$uid'><input type='button' onClick='confReset(this.form);' value='Reset Password' /></form></td>";
                        echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Adjust Balance</button></td>";
                        echo "<td><button name='friend' onclick='addAjax(".$uid.")'>Delete</button></td>";
                        echo "</tr>";
                        
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </div>

    <!-- END OF CONTENT -->

@endsection