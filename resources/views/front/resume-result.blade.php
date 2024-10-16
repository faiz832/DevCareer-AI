<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CV Optimization - DevCareer AI</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hide scrollbar in Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="bg-white">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Content -->
        <div class="max-w-[1200px] mx-auto mt-12 min-h-screen p-4">
            <div class="bg-white p-4 sm:p-8 rounded-lg shadow-md border border-gray-200">
                <div class="text-black prose max-w-none">
                    {!! $optimizedContent !!}
                </div>
            </div>
            <div class="my-12 text-center">
                <p class="text-gray-600">Want to optimize another CV?</p>
                <a href="{{ url('/resume') }}"
                    class="mt-2 inline-block px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                    Optimize Now
                </a>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>
