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
        <div class="min-h-screen">
            <div class="max-w-7xl mx-auto mt-12 p-4">
                <h1
                    class="text-6xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-400 mb-8 mt-12">
                    Optimization
                </h1>
            </div>
            <div class="max-w-md mx-auto mt-4">
                <div class="flex flex-col justify-center items-center gap-6 sm:mx-6">

                    <!-- Tampilkan Pesan Error Jika Ada -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 text-red-700 bg-red-100 border border-red-300 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Route::has('login'))
                        @auth
                            <div id="uploadContainer"
                                class="w-full max-w-md px-6 py-12 bg-white border-2 border-dashed border-gray-300 rounded-lg text-center transition-all duration-300 ease-in-out">
                                <form action="{{ route('cv.optimize') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="cv_file" id="fileInput" class="hidden"
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" onchange="showFileName()">
                                    <button type="button" onclick="document.getElementById('fileInput').click()"
                                        class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-300 ease-in-out">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Choose File
                                    </button>
                                    <p class="text-sm text-gray-600 mb-2">Supported formats: PDF, JPG, PNG. <br> Max file
                                        size 5MB.</p>
                                    <p id="fileName" class="text-sm text-gray-500 mb-4"></p>
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 mb-4 rounded transition duration-300 ease-in-out">
                                        Upload & Optimize
                                    </button>
                                    <p class="text-sm text-gray-600">Your Token: {{ Auth::user()->token ?? '0' }}
                                    </p>
                                </form>
                            </div>
                        @else
                            <div x-data="{ open: false }"
                                class="relative w-full max-w-md px-6 py-12 bg-white border-2 border-dashed border-gray-300 rounded-lg text-center transition-all duration-300 ease-in-out">
                                <button @click="open = !open"
                                    class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-300 ease-in-out">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Choose Photo
                                </button>
                                <p class="text-sm text-gray-600 mb-2">Max file size 5MB. <a href="#"
                                        class="text-blue-500 hover:underline">Sign Up</a> for more</p>
                                <p id="fileName" class="text-sm text-gray-500 mb-4"></p>

                                <!-- Modal Background -->
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 -translate-x-full"
                                    x-transition:enter-end="transform opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 translate-x-0"
                                    x-transition:leave-end="transform opacity-0 -translate-x-full" style="display: none;"
                                    class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 ease-in-out">
                                    <!-- Modal Content -->
                                    <div class="bg-white flex flex-col items-center rounded-lg shadow-lg w-[400px] p-6"
                                        @click.away="open = false">
                                        <h2 class="text-xl font-semibold my-6">Please log in to continue</h2>
                                        <svg width="100" height="100" viewBox="0 0 537 447" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" style="width: 80%; height: 100%;">
                                            <g clip-path="url(#clip0_35_987)">
                                                <path
                                                    d="M346.916 177.364C370.854 156.793 383.201 125.041 385.422 93.557C386.419 79.42 385.457 64.754 379.386 51.948C375.041 42.782 368.275 34.978 361.047 27.862C350.531 17.509 338.494 8.14901 324.385 3.82401C313.91 0.613008 302.746 0.322009 291.82 1.13201C274.427 2.42101 257.08 6.51001 241.662 14.664C226.245 22.818 212.827 35.206 204.902 50.743C197.195 65.853 194.94 83.378 196.659 100.252C199.288 126.059 211.292 150.946 230.411 168.478C236.043 173.643 242.894 178.39 249.991 179.557C236.961 225.367 202.709 359.407 202.709 359.407L400.661 362.708C400.661 362.708 362.545 228.269 346.917 177.363L346.916 177.364Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M492.743 71.611C494.071 62.538 493.397 58.878 494.725 49.804C418.98 47.421 299.894 50.717 299.894 50.717L297.18 71.329C297.18 71.329 413.591 71.557 492.743 71.611Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M297.054 71.057C291.601 116.628 280.414 307.483 280.414 307.483L476.749 306.781L492.744 71.611C492.744 71.611 327.607 71.057 297.055 71.057H297.054Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M527.454 97.075C530.285 95.518 533.116 93.961 535.947 92.404"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M410.388 155.219C409.87 155.869 409.312 156.478 408.712 157.047C403.573 161.972 395.977 163.922 388.756 164.166C381.475 164.41 374.03 163.161 367.622 159.698C365.753 158.693 363.976 157.474 362.351 156.083C358.411 152.732 355.344 148.375 353.922 143.419C352.317 137.823 352.846 131.75 354.734 126.246C359.558 112.109 374.811 101.527 389.476 104.351C393.944 105.214 402.12 107.641 407.532 113.288C411.371 117.299 414.793 123.393 415.88 128.836C417.718 138.006 416.256 147.938 410.386 155.22L410.388 155.219Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M408.712 157.047C403.573 161.972 395.977 163.922 388.756 164.166C381.475 164.41 374.03 163.161 367.622 159.698C365.753 158.693 363.976 157.474 362.351 156.083C362.757 155.606 363.184 155.098 363.641 154.55C369.095 148.03 377.645 144.202 386.146 144.476C394.656 144.74 402.943 149.107 407.97 155.972C408.224 156.327 408.478 156.683 408.711 157.048L408.712 157.047Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M379.332 120.775C377.107 122.642 375.617 125.335 375.145 128.2C374.831 130.106 374.962 132.153 375.927 133.826C377.18 135.999 379.62 137.208 382.037 137.88C385.35 138.8 389.023 138.906 392.115 137.401C396.502 135.266 397.684 130.554 396.356 125.86C395.028 121.166 385.973 115.204 379.333 120.775H379.332Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M315.567 206.555C314.801 201.768 315.502 192.975 315.3 188.131C314.848 177.275 325.128 179.882 334.276 179.17C350.053 177.943 427.049 178.446 446.315 179.386C452.398 179.683 453.843 183.653 453.843 186.661C453.843 190.768 454.772 199.914 453.843 205.8C452.88 211.899 449.779 213.187 444.719 213.388C427.057 214.087 404.534 213.762 329.321 213.762C326.701 213.762 324.029 214.08 321.511 213.356C318.993 212.631 316.264 210.915 315.567 206.555Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M315.567 256.807C314.801 252.02 315.502 243.227 315.3 238.383C314.848 227.527 325.128 230.134 334.276 229.422C350.053 228.195 427.462 228.364 446.728 229.304C452.811 229.601 454.256 233.571 454.256 236.579C454.256 240.686 454.772 250.166 453.843 256.052C452.88 262.151 449.779 263.439 444.719 263.64C427.057 264.339 404.534 264.014 329.321 264.014C326.701 264.014 324.029 264.332 321.511 263.608C318.993 262.883 316.264 261.166 315.567 256.806V256.807Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M329.726 199.516C331.589 199.516 333.1 198.005 333.1 196.142C333.1 194.279 331.589 192.768 329.726 192.768C327.863 192.768 326.352 194.279 326.352 196.142C326.352 198.005 327.863 199.516 329.726 199.516Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M348.54 199.516C350.403 199.516 351.914 198.005 351.914 196.142C351.914 194.279 350.403 192.768 348.54 192.768C346.677 192.768 345.166 194.279 345.166 196.142C345.166 198.005 346.677 199.516 348.54 199.516Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M368.909 199.516C370.772 199.516 372.283 198.005 372.283 196.142C372.283 194.279 370.772 192.768 368.909 192.768C367.046 192.768 365.535 194.279 365.535 196.142C365.535 198.005 367.046 199.516 368.909 199.516Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M387.352 199.516C389.215 199.516 390.726 198.005 390.726 196.142C390.726 194.279 389.215 192.768 387.352 192.768C385.489 192.768 383.978 194.279 383.978 196.142C383.978 198.005 385.489 199.516 387.352 199.516Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M406.166 199.516C408.029 199.516 409.54 198.005 409.54 196.142C409.54 194.279 408.029 192.768 406.166 192.768C404.303 192.768 402.792 194.279 402.792 196.142C402.792 198.005 404.303 199.516 406.166 199.516Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M426.771 199.516C428.634 199.516 430.145 198.005 430.145 196.142C430.145 194.279 428.634 192.768 426.771 192.768C424.908 192.768 423.397 194.279 423.397 196.142C423.397 198.005 424.908 199.516 426.771 199.516Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M332.387 246.273C335.564 246.129 338.744 246.062 341.924 246.073"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M333.966 250.112C335.089 248.808 336.211 247.503 337.334 246.199C338.441 247.677 339.641 248.861 340.701 250.275"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M334.51 242.366C335.712 243.795 336.005 244.87 337.333 246.198C337.725 245.562 339.024 243.701 340.068 242.419"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M351.543 246.273C354.72 246.129 357.9 246.062 361.08 246.073"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M353.122 250.112C354.245 248.808 355.367 247.503 356.49 246.199C357.597 247.677 358.797 248.861 359.857 250.275"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M353.666 242.366C354.868 243.795 355.161 244.87 356.489 246.198C356.881 245.562 358.18 243.701 359.224 242.419"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M370.699 246.273C373.876 246.129 377.056 246.062 380.236 246.073"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M372.278 250.112C373.401 248.808 374.523 247.503 375.646 246.199C376.753 247.677 377.953 248.861 379.013 250.275"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M372.822 242.366C374.024 243.795 374.317 244.87 375.645 246.198C376.037 245.562 377.336 243.701 378.38 242.419"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M389.855 246.273C393.032 246.129 396.212 246.062 399.392 246.073"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M391.434 250.112C392.557 248.808 393.679 247.503 394.802 246.199C395.909 247.677 397.109 248.861 398.169 250.275"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M391.978 242.366C393.18 243.795 393.473 244.87 394.801 246.198C395.193 245.562 396.492 243.701 397.536 242.419"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M409.178 246.273C412.355 246.129 415.535 246.062 418.715 246.073"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M410.756 250.112C411.879 248.808 413.001 247.503 414.124 246.199C415.231 247.677 416.431 248.861 417.491 250.275"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M411.301 242.366C412.503 243.795 412.796 244.87 414.124 246.198C414.516 245.562 415.815 243.701 416.859 242.419"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M428.334 246.273C431.511 246.129 434.691 246.062 437.871 246.073"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M429.912 250.112C431.035 248.808 432.157 247.503 433.28 246.199C434.387 247.677 435.587 248.861 436.647 250.275"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M430.457 242.366C431.659 243.795 431.952 244.87 433.28 246.198C433.672 245.562 434.971 243.701 436.015 242.419"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M321.535 444.901C326.841 431.158 334.104 419.949 341.34 407.117C344.266 401.929 347.215 396.707 351.046 392.146C366.279 374.018 381.065 381.233 369.044 415.686C364.751 427.99 362.799 435.803 359.423 445.481C366.805 421.361 374.752 396.261 392.348 378.187C395.558 374.89 399.126 371.826 403.348 369.996C404.979 369.289 406.758 368.769 408.519 369.008C412.2 369.508 415.225 372.9 416.009 376.531C419.283 391.695 416.498 398.954 407.941 420.064C404.841 427.713 400.757 436.404 397.154 445.291C365.885 445.291 343.372 444.9 321.535 444.9V444.901Z"
                                                    fill="#55D087" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M341.501 444.901C348.293 424.794 358.279 401.512 367.794 382.542"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M377.928 444.782C388.244 419.326 398.952 394.548 409.965 369.385"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M181.928 168.094C170.941 162.453 158.008 162.57 145.66 162.816C135.422 163.02 124.908 163.278 115.439 167.177C113.841 167.835 112.223 168.641 111.172 170.014C110.073 171.45 109.737 173.316 109.516 175.111C107.481 191.613 115.381 260.843 119.611 277.558C138.378 276.983 151.66 275.068 170.427 274.492C171.48 274.46 177.534 187.814 181.929 168.095L181.928 168.094Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M143.919 82.573C139.973 83.574 135.87 84.656 132.8 87.329C129.937 89.822 128.111 93.588 124.671 95.192C122.844 96.044 120.71 96.195 119.02 97.294C116.289 99.07 115.559 102.664 113.933 105.487C112.336 108.258 109.756 110.414 108.444 113.331C107.505 115.419 107.27 117.791 106.178 119.803C104.394 123.091 100.665 124.851 98.448 127.863C95.745 131.535 95.643 136.517 93.549 140.567C91.944 143.671 89.209 146.143 87.978 149.413C86.995 152.023 87.061 154.911 86.308 157.596C85.589 160.161 84.131 162.508 83.705 165.138C83.096 168.897 84.664 172.63 86.197 176.115C86.847 177.592 87.526 179.111 88.698 180.22C90.635 182.052 93.531 182.411 96.196 182.32C101.887 182.126 107.395 180.328 112.721 178.312C120.148 175.501 127.553 172.197 135.465 171.519C146.648 170.562 158.493 174.867 168.835 170.507C170.905 169.634 172.876 168.395 174.239 166.608C175.446 165.024 176.111 163.104 176.346 161.103C177.508 158.65 178.009 155.887 177.783 153.182C177.631 151.361 177.156 149.562 177.223 147.736C177.382 143.409 180.546 139.237 179.321 135.084C178.791 133.287 177.492 131.809 176.854 130.047C176.133 128.056 176.309 125.868 176.493 123.759C176.705 121.337 176.917 118.915 177.129 116.494C177.231 115.332 177.304 114.057 176.622 113.11C176.256 112.601 175.707 112.247 175.33 111.746C174.983 111.285 174.799 110.724 174.633 110.171C173.448 106.225 172.873 102.096 172.932 97.976C172.962 95.874 173.132 93.651 172.15 91.792C171.318 90.216 169.785 89.155 168.31 88.156C166.082 86.648 163.171 84.862 160.778 83.632C154.441 80.376 145.798 82.093 143.919 82.57V82.573Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M133.575 116.093C131.938 115.152 129.716 115.365 128.288 116.6C127.433 117.339 126.881 118.367 126.466 119.418C125.918 120.805 125.574 122.309 125.765 123.788C125.956 125.267 126.744 126.717 128.039 127.457C129.631 128.366 131.608 128.069 133.633 128.337C133.167 138.222 132.7 147.541 132.273 157.526C128.06 157.963 123.824 158.135 119.611 158.572C119.723 161.245 119.858 164.748 119.877 167.268C128.773 176.786 137.67 186.303 146.511 195.765C153.283 187.848 159.189 176.067 167.264 164.736C167.134 159.107 166.648 160.839 165.808 155.208C162.335 154.726 159.931 155.664 156.41 155.748C156.604 149.771 156.619 146.62 157.076 139.902C161.281 138.527 164.523 136.854 166.788 133.055C168.275 130.562 168.657 127.58 168.918 124.689C169.548 117.713 169.66 110.691 168.771 103.468C166.253 104.315 163.192 102.564 162.646 99.964C162.526 99.395 162.499 98.772 162.144 98.311C161.685 97.717 160.855 97.602 160.124 97.431C157.347 96.782 155.12 94.775 152.513 92.232C152.306 94.893 151.005 97.452 148.978 99.189C148.531 99.572 148.028 99.947 147.824 100.5C147.515 101.341 148.006 102.25 148.055 103.144C148.127 104.458 147.226 105.641 146.179 106.439C145.132 107.237 143.907 107.782 142.885 108.611C142.535 108.895 142.198 109.231 142.07 109.662C141.925 110.146 142.065 110.665 142.047 111.169C142.011 112.171 141.28 113.109 140.318 113.389C139.94 113.499 139.527 113.52 139.194 113.728C138.885 113.921 138.69 114.247 138.463 114.533C137.428 115.838 135.254 117.058 133.575 116.093Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M100.194 278.081C98.964 265.269 99.35 252.458 98.12 239.646C90.058 238.827 77.746 235.401 67.939 233.985C75.222 201.667 87.49 176.455 90.743 172.404C96.877 164.764 110.809 158.835 123.529 158.312C125.71 196.776 128.456 238.634 129.898 277.146C119.871 277.558 109.843 277.971 100.194 278.082V278.081Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M290.872 145.926C290.197 141.112 286.016 137.547 281.685 135.34C283.912 130.642 285.787 125.751 287.255 120.741C287.506 119.886 287.467 118.593 286.578 118.528C286.029 118.488 285.629 119.019 285.344 119.49C281.681 125.548 278.535 131.919 275.953 138.51C275.433 136.561 274.528 134.716 273.306 133.111C272.692 132.304 271.659 131.487 270.767 131.969C270.085 132.338 269.953 133.25 269.954 134.026C269.965 139.261 272.298 144.852 269.881 149.496C256.211 172.098 254.692 173.727 240.926 194.609C238.731 193.03 236.7 191.273 234.761 189.416C231.231 199.606 224.465 212.924 217.27 220.639C219.081 221.977 221.008 223.271 223.086 224.479C228.89 227.853 236.252 228.529 242.672 226.567C250.145 224.284 256.034 218.329 260.412 211.857C274.561 190.939 280.762 177.654 289.669 153.916C290.623 151.373 291.248 148.616 290.871 145.926H290.872Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M213.747 167.331C202.595 157.992 193.953 152.338 162.314 155.098C166.207 194.277 167.404 235.417 166.478 274.81C176.801 273.91 187.7 273.473 198.593 272.931C198.593 246.999 198.473 226.183 198.473 201.756C202.683 206.527 208.483 214.145 217.272 220.641C224.467 212.926 231.233 199.608 234.763 189.418C227.399 182.364 221.457 173.788 213.748 167.333L213.747 167.331Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M117.712 159.443C114.414 165.925 111.964 172.355 108.665 178.837C111.215 180.977 114.047 182.781 117.066 184.185C115.489 190.568 113.204 196.776 110.269 202.659C115.873 208.322 121.478 213.985 127.082 219.647"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M179.576 387.749C175.81 391.868 168.367 399.097 164.601 403.216C177.705 419.852 196.03 443.446 197.757 444.202C200.46 445.385 196.886 427.743 199.583 420.811C200.317 418.925 202.8 412.424 203.763 410.644C205.634 407.185 189.399 392.576 179.575 387.749H179.576Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M168.64 154.619C171.842 159.49 175.044 166.057 178.385 170.646C176.004 172.736 173.622 174.826 171.241 176.916C174.516 179.949 177.572 183.218 179.698 187.348C176.733 198.206 172.554 208.733 167.263 218.668"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M198.129 200.88C197.72 194.253 197.311 187.626 196.902 180.999"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M157.846 111.096C159.113 114.172 160.38 117.248 161.646 120.323C160.171 121.087 158.593 121.65 156.968 121.991"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M109.165 337.141C104.888 363.645 103.014 380.543 95.113 444.203"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M128.453 336.71C126.782 363.505 126.565 380.505 124.912 444.632"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M180.628 337.141C183.142 372.501 193.417 383.133 197.758 444.203"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M98.578 421.504C130.847 422.067 163.142 421.172 195.331 418.823"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M146.835 138.354C150.214 139.85 154.039 140.958 157.575 139.88"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M98.199 239.555C100.804 229.628 102.062 224.713 104.068 214.647"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M269.267 427.903C270.172 433.41 271.077 438.917 271.983 444.424C285.783 444.424 317.711 444.138 322.504 444.138C331.777 444.138 311.768 435.153 307.451 427.829C306.423 426.085 302.854 420.112 302.051 418.254C300.491 414.644 279.138 423.171 269.267 427.902V427.903Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M128.171 116.31C124.476 106.089 128.115 94.879 134.11 88.615C138.121 84.424 143.648 81.599 149.44 81.273C152.537 81.099 155.626 81.619 158.699 81.82C150.766 83.436 142.854 86.499 137.165 92.259C131.476 98.019 128.184 107.911 130.936 115.524C129.272 115.697 128.906 115.874 128.171 116.31Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M150.76 81.942C151.844 79.34 154.257 77.522 156.778 76.262C158.04 75.632 159.384 75.101 160.792 75.02C162.2 74.939 163.69 75.362 164.65 76.396C165.067 76.846 165.38 77.423 165.39 78.037C165.401 78.727 165.027 79.381 164.515 79.845C164.003 80.309 163.366 80.607 162.726 80.864C159.214 82.273 155.375 82.618 151.594 82.786C151.236 82.802 150.435 82.723 150.76 81.942Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M207.341 273.922C225.974 272.217 244.895 273.696 263.037 278.275C269.561 279.921 276.252 282.122 281.033 286.856C289.163 294.908 289.499 308.309 285.385 318.986C281.27 329.663 273.565 338.477 266.842 347.736C259.47 357.89 232.605 390.385 209.649 417.541C195.141 405.238 186.407 397.548 171.704 385.08C187.569 369.215 225.586 336.811 225.7 336.047C225.788 335.454 216.255 289.549 207.341 273.922Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M180.353 376.64C193.132 388.191 202.911 398.813 216.274 409.684"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M146.343 83.956C145.098 82.714 143.82 81.479 142.316 80.566C140.812 79.653 139.047 79.076 137.298 79.269C135.549 79.462 133.846 80.524 133.18 82.153C132.934 82.756 132.835 83.44 133.025 84.064C133.262 84.843 133.925 85.437 134.669 85.769C135.413 86.101 136.236 86.204 137.047 86.272C139.863 86.508 142.989 86.254 146.343 83.956Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M152.852 82.482C152.66 81.045 151.57 79.783 150.196 79.32C148.822 78.857 147.226 79.182 146.099 80.095C145.22 80.807 144.634 81.85 144.391 82.941C144.262 83.52 144.529 84.15 145.06 84.416C147.636 85.706 151.82 84.054 152.186 83.827C152.565 83.592 152.947 83.196 152.852 82.482Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M100.79 278.154C96.305 290.682 97.5239 305.129 104.045 316.728C107.321 322.555 112.347 324.977 118.524 327.536C124.824 330.146 131.897 329.274 138.717 329.274C161.24 329.274 184.224 330.232 212.54 328.296C218.286 337.021 222.663 345.713 226.657 355.366C237.54 381.664 250.086 407.273 264.773 432.649C279.783 427.175 294.792 421.701 311.157 416.58C304.968 401.318 275.221 329.642 262.487 303.024C254.884 287.131 250.687 279.081 233.696 274.844C225.173 272.719 207.374 273.203 198.594 272.93C190.373 272.674 136.672 275.082 100.792 278.154H100.79Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M258.389 421.013C273.831 414.769 289.273 408.525 304.716 402.281"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M176.691 329.284C184.353 328.744 184.859 330.649 185.874 332.147C186.383 332.899 186.51 333.869 186.337 334.76C185.986 336.577 184.486 338.002 182.795 338.754C181.104 339.506 179.226 339.696 177.383 339.87C159.201 341.595 110.716 341.232 107.026 340.974C100.433 340.513 100.782 331.856 105.202 330.401C108.961 329.163 163.829 330.189 176.691 329.282V329.284Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M282.593 133.366C281.069 136.418 280.661 140.289 280.783 143.698C280.811 144.481 280.975 145.403 281.683 145.739C282.223 145.996 282.893 145.781 283.329 145.372C283.765 144.963 284.015 144.399 284.237 143.844C285.154 141.553 286.078 137.455 286.426 135.013C285.895 138.167 285.081 143.018 284.55 146.173C284.471 146.644 284.392 147.132 284.517 147.593C284.642 148.054 285.033 148.479 285.51 148.483C285.835 148.486 286.131 148.299 286.381 148.092C288.793 146.097 289.048 140.932 290.357 138.089C289.844 140.158 288.765 143.641 288.287 145.719C287.92 147.315 287.584 149.04 288.23 150.544C288.363 150.854 288.592 151.184 288.929 151.203C289.143 151.215 289.341 151.095 289.516 150.97C292.133 149.095 292.779 145.542 293.216 142.352C293.462 140.554 286.221 132.564 282.592 133.367L282.593 133.366Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M68.465 131.628C67.198 117.468 65.273 103.366 62.603 88.284C42.027 88.96 19.129 88.348 0.75 88.952C1.093 98.846 2.564 112.67 4.579 122.363C19.306 122.162 38.848 121.486 53.567 121.991C55.311 122.051 66.101 129.956 68.465 131.628Z"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M13.365 113.329C13.768 110.359 14.241 107.223 16.137 104.901C18.033 102.579 21.872 101.573 24.039 103.644C25.082 104.641 25.519 106.095 26.229 107.352C26.939 108.609 28.222 109.794 29.642 109.537C31.451 109.209 32.045 106.962 33.253 105.576C34.294 104.382 35.982 103.79 37.541 104.073C39.632 104.453 41.213 106.206 43.228 106.88C44.84 107.419 46.687 107.201 48.13 106.303"
                                                    stroke="#010101" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M530.261 255.682C516.014 251.812 493.29 240.352 491.499 234.231C475.503 247.628 456.923 253.669 444.261 254.086C443.496 271.587 443.956 298.921 451.126 312.259C456.067 321.452 465.4 327.534 475.105 331.373C480.906 333.668 486.967 335.304 492.807 336.57C504.22 331.115 516.109 325.096 523.157 314.591C529.516 305.113 529.996 285.918 530.381 274.51C530.515 270.545 531.538 260.117 530.261 255.681V255.682Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M484.14 259.163C479.439 259.813 475.199 262.521 471.761 265.793C465.789 271.475 462.247 279.958 463.535 288.1C464.097 291.649 465.531 295.031 467.491 298.044C472.121 305.161 479.806 310.213 488.173 311.649C497.859 313.311 502.342 308.618 504.471 306.764C510.111 301.851 515.102 294.402 514.883 286.295C514.608 276.112 508.218 255.835 484.14 259.164V259.163Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M506.653 277.266C499.306 285.502 491.56 293.383 483.452 300.87C479.373 296.188 475.294 291.505 471.647 286.982C473.317 285.26 474.998 284.607 477.085 282.957C479.304 285.373 481.536 288.561 483.992 291.638C490.081 285.957 494.891 280.606 502.108 273.389C503.605 274.723 505.102 276.058 506.653 277.266Z"
                                                    fill="#2563eb" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M27.874 305.929C27.332 306.099 27.062 306.817 27.325 307.321C27.588 307.825 28.288 308.025 28.797 307.772C29.302 307.521 29.564 306.848 29.324 306.338C29.084 305.828 28.418 305.758 27.874 305.929Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M449.207 369.122C448.334 369.396 447.9 370.551 448.323 371.362C448.746 372.173 449.872 372.495 450.691 372.087C451.503 371.682 451.926 370.601 451.538 369.78C451.15 368.959 450.082 368.847 449.207 369.122Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M175.388 237.624C174.573 237.357 173.638 237.607 172.764 237.857C168.108 239.187 166.271 239.978 161.618 241.319C166.228 239.798 168.069 239.147 169.995 238.442C173.356 237.21 177.624 235.9 176.677 233.629C176.16 232.741 174.12 233.117 173.064 233.432C168.153 234.897 163.821 236.531 160.801 237.907C162.743 236.956 167.156 235.105 170.462 233.729C171.296 233.382 172.171 233.005 172.762 232.301C173.354 231.596 173.52 230.457 172.875 229.936C172.245 229.427 171.256 229.736 170.437 230.062C165.008 232.226 162.032 233.288 157.397 235.095C161.565 233.212 163.204 231.223 162.924 230.286C162.452 228.7 159.885 229.461 158.677 229.987C152.221 232.795 150.291 234.174 145.462 236.468C131.176 239.725 108.921 244.2 96.938 245.429C97.476 242.998 97.013 241.773 97.316 239.554C85.342 237.241 79.739 236.165 70.867 234.452C69.161 240.593 67.878 249.515 67.529 255.879C67.382 258.556 67.377 261.346 68.498 263.782C70.734 268.645 76.655 270.57 81.993 270.968C93.59 271.833 155.491 251.769 155.986 251.265C161.554 249.39 167.095 247.491 172.843 245.761C173.868 245.452 175.253 244.81 175.119 243.777C174.97 242.627 173.588 242.45 172.457 242.58C168.65 243.018 166.592 243.898 162.87 245.092C167.974 243.372 169.692 242.321 174.796 240.602C175.347 240.416 175.949 240.191 176.267 239.69C176.766 238.903 176.204 237.889 175.389 237.622L175.388 237.624Z"
                                                    fill="white" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M410.857 14.467C410.315 14.637 410.045 15.355 410.308 15.859C410.571 16.363 411.271 16.563 411.78 16.31C412.285 16.059 412.547 15.386 412.307 14.876C412.067 14.366 411.402 14.296 410.858 14.467H410.857Z"
                                                    fill="#010101" stroke="#010101" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_35_987">
                                                    <rect width="536.696" height="446.231" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        {{-- <p class="text-gray-700 my-6"></p> --}}
                                        <a href="/login"
                                            class="w-2/4 bg-white hover:bg-blue-500 text-blue-500 hover:text-white border border-blue-500 font-bold py-2 px-4 rounded inline-flex items-center justify-center my-4 transition duration-300 ease-in-out">
                                            Log In
                                        </a>
                                        <a href="/register"
                                            class="w-2/4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center justify-center mb-6 transition duration-300 ease-in-out">
                                            Sign Up
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    @endif

                    <div class="max-w-md">
                        <p class="text-2xs text-typo-secondary !mt-4 text-center">By uploading an image you agree
                            to our <a target="_blank" class="text-typo-secondary underline" draggable="false"
                                href="{{ url('/terms') }}">Terms of Service</a>.
                            To learn more about how devcareer.ai handles your personal data, check our <a
                                target="_blank" rel="noopener" class="underline" style="color: inherit;"
                                href="{{ url('/privacy') }}">Privacy
                                Policy
                            </a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <script>
        function showFileName() {
            const fileInput = document.getElementById('fileInput');
            const fileNameDisplay = document.getElementById('fileName');
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = `Selected file: ${fileInput.files[0].name}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }
    </script>
</body>

</html>
