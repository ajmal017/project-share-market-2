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
    <div class = "sysoBox sysoBoxFlex">
        <div class = "sysoContent sysoContent100">
            <h1 class = "sysoHeader1 sysoCenterText">Login to Stock Your Socks Off</h1>
            <div id = "signin">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email"><!-- {{ __('E-Mail Address') }} --></label>
                        <div>
                            <input class = "sysoInput" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter email address" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span id = "loginError" class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label for="password"><!-- {{ __('Password') }} --></label>
                        <div>
                            <input class = "sysoInput" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input class = "sysoInput" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <button class = "sysoButton" type="submit">
                                {{ __('Login') }}
                            </button>
                            <a id = "forgotten" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection