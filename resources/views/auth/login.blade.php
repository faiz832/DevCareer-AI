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
                <div class="flex items-center my-3">
                    <div class="grow">
                        <hr>
                    </div>
                    <div class="text-muted text-center pt-1 px-3">
                        or
                    </div>
                    <div class="grow">
                        <hr>
                    </div>
                </div>
                <div class="mt-4">
                    <a href=""
                        class="flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition duration-300">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        Continue with Google
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
