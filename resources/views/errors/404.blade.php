<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @section('title', 'Page Not Found')

                <div class="container mx-auto text-center py-16">
                    <h1 class="text-6xl font-bold text-gray-800">404</h1>
                    <p class="text-2xl mt-4">Oops! Halaman yang Anda cari tidak ditemukan.</p>
                    <a href="{{ route('front.index') }}" class="mt-8 inline-block bg-blue-500 text-white py-2 px-4 rounded">
                        Kembali ke Beranda
                    </a>
                </div>
        </div>
    </div>
</x-app-layout>
