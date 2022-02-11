<x-app-layout>
    {{-- <x-slot name="user"> --}}
    @if (Session::has('auth_wlha'))
        @if (!in_array(Session::get('auth_wlha.0.id_level'), [2, 3, 4, 5, 6]))
            @php
                header('Location: ' . URL::to('/auth/login/error/3/--'));
                exit();
            @endphp
        @endif
    @else
        {{-- Not yet login --}}
        @php
            header('Location: ' . URL::to('/auth/login/error/1/null'));
            exit();
        @endphp
    @endif


    {{-- @extends('layouts.app') --}}

    {{-- @section('user') --}}

    @if (Session::has('auth_wlha'))
        @include('layouts.navigation')
    @endif

    {{-- @endsection --}}
    {{-- </x-slot> --}}
</x-app-layout>
