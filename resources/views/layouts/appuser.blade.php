@extends('layouts.app')

@section('user')

    @if (Session::has('auth_wlha'))
        @if (Session::get('auth_wlha.0.id_level') == 1 )
            @php
                $url = redirect()->getUrlGenerator()->previous();
                if(substr($url, 0,4)=='http'){
                    $position = strpos($url, '/');
                    $url = substr($url,$position+2,strlen($url));
                    $position = strpos($url, '/');
                    $url = substr($url,$position,strlen($url));
                } else {
                    $position = strpos($url, '/');
                    $url = substr($url,$position,strlen($url));
                }
                $url = substr($url,1,strlen($url));
                $url = str_replace('/', '--',$url);
                header("Location: ". URL::to("/auth/login/error/0/".$url));
                exit();
            @endphp
        @else
            @if(Session::has('auth_error'))
                <script type="text/javascript">this.myalert = "<?php echo Session::get('auth_error')?>"; alert(myalert);</script>
            @endif
            @yield('contents')
        @endif
    @else
        {{-- Not yet login --}}
        @php
            header("Location: ". URL::to("/auth/login/error/1/null"));
            exit();
        @endphp
    @endif
@endsection
