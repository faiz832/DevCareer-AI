<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6">
                <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('New Course') }}
                    </h2>

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="py-3 px-4 mb-4 w-full rounded-lg bg-red-500 text-white">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="path_trailer" :value="__('Trailer Path')" />
                            <x-text-input id="path_trailer" class="block mt-1 w-full" type="text" name="path_trailer" :value="old('path_trailer')" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="about" :value="__('About')" />
                            <textarea id="about" name="about" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" required>{{ old('about') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                            <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Course') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
