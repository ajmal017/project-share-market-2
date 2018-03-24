@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <h1>Create an account</h1>
    <form>
        <p><input type="text" name="username"></p>
        <p>
            <input type="password" name="password" id="password" onblur="pwStrengthCheck()"><br>
            <span id="pw-strength"></span>
        </p>
        <p><input type="submit" value="Sign Up"></p>
    </form>

    <!-- END OF CONTENT -->

@endsection