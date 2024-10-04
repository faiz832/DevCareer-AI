<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6 h-screen">
                <div class="space-y-6">
                    <div class="text-2xl font-semibold">Add Teacher</div>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    <!-- Search Email -->
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div x-data="studentEmailSearch()" x-init="initSelectize" class="flex flex-col space-y-4">
                            <form action="{{ route('admin.teachers.store') }}" method="POST" class="flex space-x-2">
                                @csrf
                                <input type="email" name="email" id="email-search" class="rounded-lg border border-slate-300 w-full px-4 py-2" placeholder="Search for student email..." required>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition duration-300 ease-in-out">
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-xl">Teachers</div>
                    <div class="rounded-lg px-6 pt-6 pb-2 shadow-lg border border-gray-200">
                        <table id="dataTable" class="display" style="width:100%">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Example row, repeat as needed -->
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="{{ Storage::disk('public')->exists($teacher->user->avatar) ? Storage::url($teacher->user->avatar) : asset('assets/images/default-avatar.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $teacher->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $teacher->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $teacher->created_at->format('Y-m-d') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <button
                                            class="text-blue-500 hover:text-white font-semibold bg-white hover:bg-blue-500 border border-blue-500 rounded px-2 py-1 transition duration-300 ease-in-out">View</button>
                                        <button
                                            class="text-yellow-500 hover:text-white font-semibold bg-white hover:bg-yellow-500 border border-yellow-500 rounded px-2 py-1 transition duration-300 ease-in-out">Edit</button>
                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-white font-semibold bg-white hover:bg-red-500 border border-red-500 rounded px-2 py-1 transition duration-300 ease-in-out" onclick="return confirm('Are you sure you want to remove this teacher?')">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
