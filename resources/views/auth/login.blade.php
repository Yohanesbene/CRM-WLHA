@extends('layouts.app')

@section('content')

    <div class="container">
        <div>Login</div>
        @if(Session::has('login_error'))
            <ul>
                <li>{{ Session::get('login_error') }}</li>
            </ul>
        @endif
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form class="" action="/auth/login" method="post">
            {{ csrf_field() }}
            <div>
                <label class="" for="username">Username</label>
                <input class="" type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            </div>
            <div>
                <label class="" for="password">Password</label>
                <input class="" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
            </div>
            <div class="flex items-center justify-between">
                <input class="" type="submit" value="Login">
            </div>
        </form>
        @if(Session::has('auth_error'))
            <script type="text/javascript">this.myalert = "<?php echo Session::get('auth_error')?>"; alert(myalert);</script>
        @endif


    </div>
@endsection
