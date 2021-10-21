@extends('layouts.appuser')

@section('contents')
    USER DASHBOARD

    {{-- <div>
        @if (Session::has('auth_wlha'))
            <div class="alert-content ml-4">
                <div class="alert-description text-sm text-red-600">
                    {{ Session::get('auth_wlha') }}
                </div>
                {{ Session::forget('auth_wlha') }}
            </div>
        @endif
    </div> --}}
@endsection
