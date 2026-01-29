<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Station Dashboard</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <meta http-equiv="refresh" content="15">
</head>
<body class="bg-gray-900 min-h-screen p-6 md:p-12 text-white">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-black mb-8 text-center tracking-tighter uppercase italic">
            STATION PRINT <span class="text-blue-500">CONTROL</span>
        </h1>

        <div class="bg-white p-6 rounded-[30px] shadow-2xl mb-12 text-center max-w-sm mx-auto border-b-8 border-blue-500 transition-transform hover:scale-105">
            <h3 class="font-bold text-gray-800 mb-4">Scan untuk Upload File</h3>
            <div class="w-52 h-52 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center overflow-hidden border-2 border-gray-200">
                <img src="{{ $qrCodeUrl }}" alt="QR Code" class="w-full h-full">
            </div>
            <p class="mt-4 text-[10px] text-blue-600 font-mono font-bold px-2">{{ config('app.url') }}/upload</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($printings as $p)
                @php
                    $extension = pathinfo($p->file_path, PATHINFO_EXTENSION);
                    $isPdf = strtolower($extension) === 'pdf';
                @endphp

                <div class="bg-gray-800 border border-gray-700 rounded-3xl p-6 shadow-xl transition-all hover:border-blue-500">
                    <div class="flex items-start justify-between mb-6">
                        <div class="p-4 {{ $isPdf ? 'bg-red-500' : 'bg-blue-600' }} rounded-2xl text-white shadow-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full {{ $p->status == 'paid' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ $p->status }}
                        </span>
                    </div>

                    <h3 class="font-bold text-white truncate mb-1 text-lg" title="{{ $p->filename }}">
                        {{ $p->filename }}
                    </h3>
                    <p class="text-[10px] text-gray-500 mb-6 italic">{{ $p->created_at->diffForHumans() }}</p>

                    <div class="flex gap-3">
                        <button onclick="bukaDanPrint('{{ Storage::url($p->file_path) }}')" 
                                class="flex-1 bg-white text-gray-900 text-center py-3 rounded-xl text-xs font-black hover:bg-blue-500 hover:text-white transition-all">
                            BUKA & PRINT
                        </button>
                        
                        <form action="{{ route('print.done', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin dek? Filenya sudah benar-benar keluar dari printer?')">
                            @csrf
                            <button type="submit" 
                                    class="p-3 bg-gray-700 text-white rounded-xl hover:bg-green-500 transition-all border border-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-32 bg-gray-800/30 rounded-[40px] border-4 border-dashed border-gray-700">
                    <p class="text-gray-600 font-bold text-xl uppercase tracking-widest">Antrean Kosong Co!</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
    function bukaDanPrint(url) {
        // Buka tab baru
        const win = window.open(url, '_blank');
        
        // Cek apakah pop-up diblokir
        if (win) {
            // Beri perintah print setelah tab selesai loading
            win.onload = function() {
                win.print();
            };
            
            // Fallback: Jika onload tidak jalan (karena cross-origin), jalankan print setelah 1 detik
            setTimeout(() => {
                win.print();
            }, 1000);
        } else {
            alert('Pop-up terblokir! Izinkan pop-up di browser ROG-mu dulu Yan!');
        }
    }
    </script>
</body>
</html>