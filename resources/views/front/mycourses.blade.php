<x-app-layout>
    {{-- <div class="h-[500px] py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Dashboard') }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content (Blank Space) -->
            <div class="w-full lg:w-5/6 bg-slate-100 h-screen rounded-lg">
            </div>
        </div>
    </div>
</x-app-layout>
