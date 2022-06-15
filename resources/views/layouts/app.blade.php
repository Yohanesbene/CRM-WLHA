<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Sistem Informasi Wisma Harapan Asri</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Scripts -->
  <script src="{{ asset(mix('js/app.js')) }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
  {{-- <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script> --}}

  <!-- Ajax -->
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" /> --}}

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

  {{-- <link rel="stylesheet" href="{{ url('css/select2-tailwind.css') }}"> --}}
  <style>
    [x-cloak] {
      display: none
    }
  </style>
</head>

<body class="font-sans antialiased">

  <main class="h-screen w-screen" x-data="{ sidebarOpen: false }">
    @include('layouts.navigation')

  </main>
  {{-- <div class="fixed bottom-0 w-full bg-white text-center">
    Dibuat oleh Teknik Informatika Universitas Katolik Soegijapranata (UNIKA Soegijapranata)
  </div> --}}
</body>

</html>
