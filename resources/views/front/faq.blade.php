<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FAQ - DevCareer AI</title>

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
        <div class="bg-white py-12 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1
                    class="text-6xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-400 mb-8 mt-12">
                    Frequently Asked Questions</h1>
                <p class="text-center text-gray-500 mb-24 text-xl">Find answers to common questions about our
                    services.
                </p>

                @php
                    $faqs = [
                        [
                            'question' => 'What is DevCareer AI?',
                            'answer' =>
                                'DevCareer AI is a career empowerment platform offering skill courses and AI-powered CV optimization to help you succeed in the job market.',
                        ],
                        [
                            'question' => 'How does the CV optimization feature work?',
                            'answer' =>
                                'Our AI analyzes your CV and provides improvement suggestions for layout, content, and key highlights to make it stand out.',
                        ],
                        [
                            'question' => 'Are the courses free?',
                            'answer' =>
                                'Some courses are free, but full access to all courses and advanced features requires a premium subscription.',
                        ],
                        [
                            'question' => 'What are the benefits of a premium subscription?',
                            'answer' => '<ul class="list-disc pl-4">
                        <li>Unlimited course access</li>
                        <li>5 AI CV optimization tokens per month</li>
                        <li>Exclusive content and features</li>
                        <li>Priority support</li>
                    </ul>',
                        ],
                        [
                            'question' => 'How do I subscribe to the premium plan?',
                            'answer' =>
                                'Visit our Pricing page, choose a plan, and complete the payment to unlock premium features.',
                        ],
                        [
                            'question' => 'How many tokens do I get with a subscription?',
                            'answer' => 'Premium members get 5 tokens per month to optimize their CVs using AI.',
                        ],
                        [
                            'question' => 'Can unused tokens roll over?',
                            'answer' => 'No, tokens reset monthly, so be sure to use them before the month ends.',
                        ],
                        [
                            'question' => 'Does completing courses guarantee a job?',
                            'answer' =>
                                'While we provide valuable skills and guidance, job outcomes depend on your effort. We help make you more competitive but can\'t guarantee employment.',
                        ],
                        [
                            'question' => 'How do I contact support?',
                            'answer' => 'Reach our support team through email or the Contact Us page on the website.',
                        ],
                        [
                            'question' => 'Do courses come with certificates?',
                            'answer' =>
                                'Yes, some courses offer certifications to enhance your professional credibility.',
                        ],
                        [
                            'question' => 'How do I use CV optimization tokens?',
                            'answer' =>
                                'Upload your CV, and the AI will provide feedback. Each CV analysis consumes one token.',
                        ],
                        [
                            'question' => 'What payment methods are accepted?',
                            'answer' => 'We accept credit/debit cards, and local payment options.',
                        ],
                    ];
                @endphp

                <div x-data="{
                    activeAccordion: null,
                    setActiveAccordion(id) {
                        this.activeAccordion = this.activeAccordion === id ? null : id
                    }
                }" class="space-y-4">
                    @foreach ($faqs as $index => $faq)
                        <div
                            class="bg-white rounded-lg border overflow-hidden hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                            <button @click="setActiveAccordion({{ $index }})" class="w-full p-6 text-left">
                                <h3 class="text-lg font-semibold flex items-center justify-between">
                                    <span>{{ $faq['question'] }}</span>
                                    <svg class="w-6 h-6 text-gray-400 transform transition-transform duration-300"
                                        :class="{ 'rotate-180': activeAccordion === {{ $index }} }"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </h3>
                            </button>
                            <div x-ref="container{{ $index }}"
                                x-bind:style="activeAccordion === {{ $index }} ?
                                    'max-height: ' + $refs.container{{ $index }}.scrollHeight + 'px' :
                                    'max-height: 0px'"
                                class="overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="px-6 pb-6 text-gray-600">
                                    {!! $faq['answer'] !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Contact Section -->
                <div class="mt-12 text-center">
                    <p class="text-gray-600">Still have questions?</p>
                    <a href="{{ url('https://api.whatsapp.com/') }}" target="_blank"
                        class="mt-2 inline-block px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>
