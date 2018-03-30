@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <p>
        
        <div id = "temporaryBox">
            <h1>Welcome {{ Auth::user()->name }}!</h1>
            <a id="logoutLink" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
</p>
    <!-- END OF CONTENT -->

@endsection