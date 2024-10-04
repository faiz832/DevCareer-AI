<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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

        <!-- Hero Section -->
        <div class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg h-[400px]">
                <div class="flex items-center h-full">
                    <div class="p-12">
                        <h1 class="text-4xl font-semibold mb-4 text-white">Checkout</h1>
                        <p class="text-white">Tampilan Detail Checkout, Upload Bukti Pembayaran saja</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>
