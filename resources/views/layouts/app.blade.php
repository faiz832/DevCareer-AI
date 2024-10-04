<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.tailwindcss.css"> --}}

    <style>
        /* Hide scrollbar in Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navbar')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('layouts.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="{{ asset('js/table.js') }}"></script>
    <script>
        new DataTable('#dataTable');
    </script>
</body>

</html>
