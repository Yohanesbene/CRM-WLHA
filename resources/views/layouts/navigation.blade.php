<div class="flex h-screen">
    <!-- START: Side Navbar -->
    <div class="flex flex-col justify-between w-80 py-6 px-4">
        <div class="flex flex-col space-y-4">
            <div class="items-center justify-center border-b-2 pb-4">
                <h1 class="text-2xl font-bold uppercase text-center text-indigo-500 tracking-wide">ASKEP</h1>
            </div>
            @if (Session::get('auth_wlha.0.id_level') == 1 )
                <a href="#" class="flex mt-4 p-4 items-center bg-indigo-600 rounded-md space-x-4 text-white font-semibold text-lg hover:text-indigo-600 transition duration-200">
                    <svg class="w-6 h-6 mr-4 text-white hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Kepegawaian
                </a>
            @endif
            @if (Session::get('auth_wlha.0.id_level') == 2 || Session::get('auth_wlha.0.id_level') == 1)
                <a href="#" class="flex mt-4 p-4 items-center space-x-4 text-gray-400 font-semibold text-lg hover:text-indigo-600 transition duration-200">
                    <svg class="w-6 h-6 mr-4 text-gray-400 hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Penghuni
                </a>
            @endif
            @if (Session::get('auth_wlha.0.id_level') == 3 || Session::get('auth_wlha.0.id_level') == 4 || Session::get('auth_wlha.0.id_level') == 1)
                <a href="#" class="flex mt-4 p-4 items-center space-x-4 text-gray-400 font-semibold text-lg hover:text-indigo-600 transition duration-200">
                    <svg class="w-6 h-6 mr-4 text-gray-400 hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                    Medical Record
                </a>
            @endif
            @if (Session::get('auth_wlha.0.id_level') == 6 || Session::get('auth_wlha.0.id_level') == 1)
                <a href="#" class="flex mt-4 p-4 items-center space-x-4 text-gray-400 font-semibold text-lg hover:text-indigo-600 transition duration-200">
                    <svg class="w-6 h-6 mr-4 text-gray-400 hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Inventaris
                </a>
            @endif
            @if (Session::get('auth_wlha.0.id_level') == 5 || Session::get('auth_wlha.0.id_level') == 1)
                <a href="#" class="flex mt-4 p-4 items-center space-x-4 text-gray-400 font-semibold text-lg hover:text-indigo-600 transition duration-200">
                    <svg class="w-6 h-6 mr-4 text-gray-400 hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Fisioterapi
                </a>
            @endif
            @if (Session::get('auth_wlha.0.id_level') == 3 || Session::get('auth_wlha.0.id_level') == 4 || Session::get('auth_wlha.0.id_level') == 1)
                <a href="#" class="flex mt-4 p-4 items-center space-x-4 text-gray-400 font-semibold text-lg hover:text-indigo-600 transition duration-200">
                    <svg class="w-6 h-6 mr-4 text-gray-400 hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Mobilitas
                </a>
            @endif
        </div>
        <div class="flex flex-col space-y-4">
            <a href="{{route('auth.logout')}}" class="flex mt-4 p-4 items-center space-x-4 text-gray-400 font-semibold text-lg hover:text-indigo-600 transition duration-200">
                <svg class="w-6 h-6 mr-4 text-gray-400 hover:text-indigo-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Keluar
            </a>
        </div>
    </div>
    <!-- END: Side Navbar -->
    <div class="flex-auto bg-indigo-50">
        {{ $slot }}
    </div>
</div>