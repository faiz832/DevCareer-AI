<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6">
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ __('Profile') }}
                    </h2>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
