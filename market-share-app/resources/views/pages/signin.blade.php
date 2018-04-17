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
    <a class = "sysoLink" href='about'>About/FAQ</a>
@endsection

@section('content')
    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <!-- old
    <h1>Create an account</h1>
    <form>
        <p><input type="text" name="username"></p>
        <p>
            <input type="password" name="password" id="password"><br>
        </p>
        <p><input type="submit" value="Log In"></p>
    </form> -->
    <div class = "sysoBox sysoBoxFlex">
        <div class = "sysoContent sysoContent100">
            <h1 class = "sysoAuth">Login to Stock Your Socks Off</h1>
            <div id = "signin">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email"><!-- {{ __('E-Mail Address') }} --></label>
                        <div>
                            <input id="emails" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter email address" name="email" value="{{ old('email') }}" required autofocus>
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
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter password" name="password" required>

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
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <button type="submit">
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