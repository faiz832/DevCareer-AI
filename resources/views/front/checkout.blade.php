<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Checkout - DevCareer AI</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="bg-white">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Hero Section with Background -->
        <div class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg h-[400px] relative overflow-hidden">
                <div class="flex flex-col items-center justify-center h-full text-white z-10 relative">
                    <div class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        Invest In Yourself Today
                    </div>
                    <h1 class="text-4xl font-bold mb-4">Checkout Subscription</h1>
                </div>
            </div>
        </div>

        <!-- Checkout Content -->
        <div class="max-w-[1200px] mx-auto p-4 py-12 lg:py-20">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Package Details -->
                <div class="w-full md:w-1/2 bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-semibold mb-6">Package</h2>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-full mr-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-xl">Premium</h3>
                                <p class="text-gray-600">30 days access</p>
                            </div>
                        </div>
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm">Popular</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Access all course materials
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Priority support
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            5 CV Optimization tokens
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Certificate of completion
                        </li>
                    </ul>
                    <div class="text-3xl font-bold">Rp 100.000</div>
                </div>

                <!-- Payment Form -->
                <div class="w-full md:w-1/2 bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-semibold mb-6">Send Payment</h2>
                    <form action="{{ route('front.checkout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center">
                                <span>Bank Name</span>
                                <span class="font-semibold">BNI</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Account Number</span>
                                <span class="font-semibold">085211553430</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Account Name</span>
                                <span class="font-semibold">PT DevCareer AI Indonesia</span>
                            </div>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold mb-4">Confirm Your Payment</h3>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-500 transition duration-300">
                                <input type="file" name="proof" id="proof" class="hidden" required
                                    onchange="updateFileName(this)">
                                <label for="proof" class="cursor-pointer">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span id="fileLabel" class="text-gray-600">Add a file attachment</span>
                                    <p id="fileName" class="mt-2 text-sm text-gray-600 hidden"></p>
                                </label>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            I've Made The Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0].name;
            document.getElementById('fileLabel').textContent = 'File selected';
            document.getElementById('fileName').textContent = fileName;
            document.getElementById('fileName').classList.remove('hidden');
        }
    </script>
</body>

</html>
