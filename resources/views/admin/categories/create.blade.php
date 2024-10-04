<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6">
                <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('New Category') }}
                    </h2>

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="py-3 px-4 mb-4 w-full rounded-lg bg-red-500 text-white">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    @if(session('success'))
                        <div class="py-3 px-4 mb-4 w-full rounded-lg bg-green-500 text-white">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="icon" :value="__('Icon')" />
                            <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" required autofocus autocomplete="icon" />
                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="font-bold py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                                Add New Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
