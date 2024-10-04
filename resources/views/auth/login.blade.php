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
</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Left side - Digital platform content -->
        <div
            class="hidden md:flex w-3/6 bg-gradient-to-br from-blue-700 to-blue-400 p-12 items-center justify-center relative overflow-hidden">

            <!-- Content container with backdrop-filter for blur effect -->
            <div
                class="relative z-10 bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded p-12 lg:px-12 lg:py-24">
                <div class="text-white max-w-lg">
                    <h1 class="text-4xl lg:text-6xl font-bold mb-8">Digital platform for distance learning.</h1>
                    <p class="text-sm lg:text-lg w-3/4">Experience seamless online education with our cutting-edge
                        platform.</p>
                </div>
            </div>
        </div>

        <!-- Right side - Login form -->
        <div class="w-full md:w-4/6 bg-white p-16 flex items-center justify-center md:justify-start">
            <div class="w-full max-w-md">
                <a href="{{ url('/') }}" class="flex items-center w-max -ml-1.5 group">
                    <svg class="w-6 transform transition-transform duration-300 group-hover:-translate-x-1"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M15 18L9 12L15 6" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <span class="text-xl text-blue-500">Home</span>
                </a>

                <div class="mb-8">
                    <h2 class="mt-4 text-4xl font-bold">Log In</h2>
                    <p class="mt-2 text-gray-600">Hey, Welcome Back!</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-text-input id="email" class="block mt-1 w-full p-2 border rounded" type="email"
                            name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-text-input id="password" class="block mt-1 w-full p-2 border rounded" type="password"
                            name="password" required autocomplete="current-password" placeholder="Password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mb-4">
                        <x-primary-button
                            class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
