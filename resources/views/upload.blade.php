<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File - Print Station</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen"> <div class="flex items-center justify-center min-h-screen p-4">
    <form action="/upload" method="POST" enctype="multipart/form-data" id="uploadForm" class="w-full max-w-md">
        @csrf
        <label for="input-file" id="dropzone" class="block w-full p-8 bg-gray-800 text-center shadow-2xl rounded-[40px] cursor-pointer border-2 border-gray-700 hover:border-blue-500 transition-all">
            <input type="file" name="file" id="input-file" onchange="document.getElementById('uploadForm').submit()" hidden />

            <div id="upload-form" class="w-full h-72 border-4 border-dashed border-gray-700 bg-gray-900/50 rounded-[30px] flex flex-col justify-center items-center p-6">
                @if (session('success'))
                    <div class="animate-bounce mb-4">
                        <span class="text-6xl">✅</span>
                    </div>
                    <p class="text-green-400 font-black text-2xl tracking-tighter uppercase">Berhasil!</p>
                    <p class="text-xs text-gray-500 mt-2">Cek antreanmu di layar Station</p>
                @else
                    <div class="bg-blue-600/20 p-6 rounded-full mb-6">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                    </div>
                    <p class="text-white font-bold text-lg">Ketuk untuk Upload</p>
                    <span class="block text-[10px] mt-4 text-gray-500 uppercase tracking-widest">Mendukung PDF, DOCX, & Gambar</span>
                @endif
            </div>
        </label>
        @error('file')
            <div class="mt-4 bg-red-500/10 text-red-500 p-4 rounded-2xl text-xs font-bold text-center border border-red-500/20">
                ⚠️ {{ $message }}
            </div>
        @enderror
    </form>
</div>

</body>
</html>