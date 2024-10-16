<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Privacy Policy - DevCareer AI</title>

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
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
                <h1
                    class="text-6xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-400 mb-8 mt-12">
                    Privacy Policy</h1>
                <p class="text-center text-gray-500 mb-24">Last updated: {{ date('F d, Y') }}</p>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-6 lg:p-8">
                        @php
                            $privacyPolicies = [
                                [
                                    'title' => 'Data Collection',
                                    'content' =>
                                        'We collect personal information such as your name, email address, and payment details when you register, subscribe, or use our services. This information is essential for account management and improving your experience.',
                                ],
                                [
                                    'title' => 'Use of Data',
                                    'content' =>
                                        'Your data is used to provide and enhance the services you request, including course access, CV optimization, and personalized recommendations.',
                                ],
                                [
                                    'title' => 'Data Sharing',
                                    'content' =>
                                        'We do not share your personal information with third parties, except when required by law or to provide essential services (e.g., payment processing).',
                                ],
                                [
                                    'title' => 'Cookies',
                                    'content' =>
                                        'DevCareer AI uses cookies to track user sessions, preferences, and improve platform functionality. You can disable cookies in your browser settings, but this may affect the platform\'s usability.',
                                ],
                                [
                                    'title' => 'Data Security',
                                    'content' =>
                                        'We implement security measures to protect your personal data from unauthorized access. However, no system is 100% secure, and we cannot guarantee absolute protection.',
                                ],
                                [
                                    'title' => 'Third-Party Links',
                                    'content' =>
                                        'Our platform may include links to third-party websites. DevCareer AI is not responsible for the privacy practices or content of these external sites.',
                                ],
                                [
                                    'title' => 'Your Rights',
                                    'content' =>
                                        'You have the right to access, correct, or delete your personal data at any time. Contact us if you wish to make changes to your account information.',
                                ],
                                [
                                    'title' => 'Changes to Privacy Policy',
                                    'content' =>
                                        'DevCareer AI reserves the right to modify this privacy policy. Any changes will be communicated to users via email or through platform updates.',
                                ],
                            ];
                        @endphp

                        <div class="space-y-6">
                            @foreach ($privacyPolicies as $index => $policy)
                                <div class="border-b border-gray-200 pb-6 last:border-b-0 last:pb-0">
                                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $index + 1 }}.
                                        {{ $policy['title'] }}</h2>
                                    <p class="text-gray-600">{{ $policy['content'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>
