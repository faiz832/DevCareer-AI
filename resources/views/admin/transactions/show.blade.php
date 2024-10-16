<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6">
                <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                        Transaction Details
                    </h2>

                    <div class="flex flex-row gap-x-10 w-full">
                        <div class="w-1/2">
                            <img src="{{ Storage::url($transaction->proof) }}"
                                class="w-full h-full object-cover rounded-lg"
                                alt="{{ Storage::url($transaction->proof) }}">
                        </div>
                        <div class="flex flex-col gap-y-10 w-1/2">
                            <div>
                                <p class="text-slate-500 text-sm">Total Amount</p>
                                <h3 class="text-indigo-950 text-xl font-bold">Rp
                                    {{ number_format($transaction->total_amount, 0, ',', '.') }}</h3>
                            </div>
                            <div>
                                <p class="text-slate-500 text-sm mb-2">Status</p>
                                @if ($transaction->is_paid)
                                    <span
                                        class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                                        ACTIVE
                                    </span>
                                @else
                                    <span
                                        class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                                        PENDING
                                    </span>
                                @endif
                            </div>
                            <div>
                                <p class="text-slate-500 text-sm">Date</p>
                                <h3 class="text-indigo-950 text-xl font-bold">
                                    {{ $transaction->created_at->format('Y-m-d') }}</h3>
                            </div>
                            <div>
                                <p class="text-slate-500 text-sm">Subscription Start At</p>
                                <h3 class="text-indigo-950 text-xl font-bold">
                                    @if ($transaction->subscription_start_date)
                                        {{ $transaction->subscription_start_date->format('Y-m-d') }}
                                    @else
                                        Not started yet
                                    @endif
                                </h3>
                            </div>
                            <div class="">
                                <p class="text-slate-500 text-sm">Student</p>
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $transaction->user->name }}</h3>
                            </div>
                        </div>
                    </div>
                    @if (!$transaction->is_paid)
                        <form action="{{ route('admin.subscribe_transactions.update', $transaction) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex justify-end gap-4 mt-12 border-t border-gray-300">
                                <a href="{{ route('admin.subscribe_transactions.index') }}"
                                    class="block py-2 px-4 mt-6 bg-white text-gray-700 rounded border border-gray-300 hover:bg-gray-50 transition duration-300 ease-in-out">
                                    Back
                                </a>
                                <button type="submit"
                                    class="py-2 px-4 mt-6 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300 ease-in-out">
                                    Approve Transaction
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="flex justify-end mt-12 border-t border-gray-300">
                            <a href="{{ route('admin.subscribe_transactions.index') }}"
                                class="block py-2 px-4 mt-6 bg-white text-gray-700 rounded border border-gray-300 hover:bg-gray-50 transition duration-300 ease-in-out">
                                Back
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
