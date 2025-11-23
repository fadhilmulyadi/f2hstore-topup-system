@props([
    'name',      // Sebelumnya 'title'
    'thumbnail', // Sebelumnya 'image'
    // Karena kolom description dihapus dari DB, kita set default text agar tampilan tetap rapi
    'description' => 'Top up resmi, murah, aman, dan terpercaya.' 
])

<div class="bg-[#27272a] shadow-2xl rounded-[2rem] p-6 border border-gray-700/50 sticky top-24">
    <div class="relative w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-lg mb-6 group border border-gray-700/30">
        <img src="{{ $thumbnail }}" 
             alt="{{ $name }}" 
             class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-out">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
        
        <div class="absolute bottom-5 left-5 text-white z-10">
            <h2 class="text-2xl font-extrabold tracking-tight leading-tight mb-0.5">{{ $name }}</h2>
            
            <p class="text-sm font-medium text-gray-300">Official Game</p>
        </div>
    </div>
    
    <div class="space-y-4 mb-6">
        <div class="flex items-center gap-4 group">
            <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center group-hover:bg-green-500/20 transition-colors border border-green-500/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors">Proses Cepat & Otomatis</span>
        </div>

        <div class="flex items-center gap-4 group">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center group-hover:bg-blue-500/20 transition-colors border border-blue-500/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors">Layanan Chat 24/7</span>
        </div>
    </div>

    <div class="h-px w-full bg-gray-700/50 mb-6"></div>

    <div class="text-sm text-gray-500 leading-relaxed">
        {{ $description }}
    </div>
</div>