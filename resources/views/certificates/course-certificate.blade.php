<div class="bg-blue-600 text-white p-8 text-center font-sans">
    <h1 class="text-4xl font-bold mb-4">CERTIFICATE OF COMPLETION</h1>
    <h2 class="text-3xl font-bold mb-2">{{ $user->name }}</h2>
    <p class="text-xl mb-6">Has successfully completed</p>
    <h3 class="text-2xl font-bold mb-4">{{ $course->name }}</h3>
    {{-- <p class="text-xl mb-8">on {{ $completionDate->format('F d, Y') }}</p> --}}
    <div class="flex items-center justify-center">
        <img src="{{ asset('img/signature.png') }}" alt="Signature" class="h-12 mr-2">
        <div>
            <p class="text-lg font-bold">Aziz Simatupang</p>
            <p class="text-base">CEO DevCareer AI</p>
        </div>
    </div>
</div>
