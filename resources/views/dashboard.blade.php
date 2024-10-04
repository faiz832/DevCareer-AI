<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full min-h-screen lg:w-5/6">
                @role('owner')
                    <div class="space-y-6">
                        <div class="">
                            <div class="text-2xl font-semibold">Hello {{ Auth::user()->name }}</div>
                            <h1 class="text-sm text-gray-500">Welcome Back!</h1>
                        </div>

                        <!-- Statistic -->
                        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg p-6 shadow-xl">
                            <div class="text-lg font-semibold text-white mb-4">Statistics</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                                <path
                                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Teachers</div>
                                            <div class="text-xs">{{ $teacherCount }}+</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Students</div>
                                            <div class="text-xs">{{ $studentCount }}+</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Courses</div>
                                            <div class="text-xs">{{ $courseCount }}+</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Transactions</div>
                                            <div class="text-xs">{{ $revenueTotal }}+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activity -->
                        <div class="text-xl">Activity</div>
                        <div class="rounded-lg px-6 pt-6 pb-2 shadow-lg border border-gray-200">
                            <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Account</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Details</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Example row, repeat as needed -->
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="{{ $activity->causer->avatar ?? asset('images/default-avatar.png') }}" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $activity->causer->name ?? 'System' }}</div>
                                                        <div class="text-sm text-gray-500">{{ $activity->causer->email ?? '' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $activity->description }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    @if($activity->subject)
                                                        {{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}
                                                    @endif
                                                    @if($activity->properties->has('attributes'))
                                                        @foreach($activity->properties['attributes'] as $key => $value)
                                                            <div>{{ $key }}: {{ is_array($value) ? json_encode($value) : $value }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $activity->created_at->format('Y-m-d H:i') }}</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    {{-- <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                    <div class="text-sm text-gray-500">john@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Student</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Introduction to Web Development</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">2023-09-20</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                    </tr> --}}
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endrole

                @role('teacher')
                    <div class="space-y-6">
                        <div class="">
                            <div class="text-2xl font-semibold">Hello {{ Auth::user()->name }}</div>
                            <h1 class="text-sm text-gray-500">Welcome Back!</h1>
                        </div>

                        <!-- Statistic -->
                        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg p-6 shadow-xl">
                            <div class="text-lg font-semibold text-white mb-4">Statistics</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">My Courses</div>
                                            <div class="text-xs">100+</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">My Students</div>
                                            <div class="text-xs">100+</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('student')
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
