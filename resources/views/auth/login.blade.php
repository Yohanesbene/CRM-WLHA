<x-guest-layout>


{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div  class="font-sans text-gray-900 antialiased">
    <div class="flex flex-col min-h-screen bg-gray-100 py-10">
        <div class="grid place-items-center mx-2 my-20 sm:my-auto">
            <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12 px-6 py-10 sm:px-10 sm:py-6 bg-white rounded-lg shadow-md lg:shadow-lg">
                <h2 class="text-center font-bold uppercase text-2xl lg:text-3xl text-gray-800 mb-14 mt-8">
                    Login
                </h2>
                <!-- Validation Error -->
                @if(Session::has('login_error'))
                <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                    <ul>
                        <li>{{ Session::get('login_error') }}</li>
                    </ul>
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::has('auth_error'))
                <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                    <script type="text/javascript">this.myalert = "<?php echo Session::get('auth_error')?>"; alert(myalert);</script>
                </div>
                @endif

                <div class="mb-4">
                    <form class="" action="{{ route('auth.login.proses')}}" method="post">
                        {{ csrf_field() }}
                        <label class="block text-sm font-semibold text-gray-600 uppercase" for="username">Username</label>
                        <input class="block w-full py-3 px-1 mt-2 text-gray-800 appearance-none border-b-2 border-gray-100 focus:text-gray-500 focus:outline-none focus:border-green-200" type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}" autofocus autocomplete="off">

                        <label class="block text-sm font-semibold text-gray-600 uppercase mt-4" for="password">Password</label>
                        <input class="block w-full py-3 px-1 mt-2 text-gray-800 appearance-none border-b-2 border-gray-100 focus:text-gray-500 focus:outline-none focus:border-green-200" type="password" name="password" placeholder="Masukkan Password" value="{{ old('password') }}" autofocus autocomplete="off">
                        <input class="w-full py-3 mt-8 bg-green-500 rounded-sm font-medium text-white uppercase focus:outline-none hover:bg-green-600 hover:shadow-none transition duration-200 mb-6" type="submit" value="Login">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
</x-guest-layout>