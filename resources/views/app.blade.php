<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Metadata dasar menentukan encoding, ukuran tampilan, dan bahasa dokumen. --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Nama aplikasi dipakai sebagai judul halaman oleh Inertia. --}}
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        {{-- Bootstrap menyediakan gaya dan komponen antarmuka yang digunakan halaman. --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        {{-- @routes menyediakan helper route untuk JavaScript; @vite memuat aset aplikasi; @inertiaHead mengisi head halaman Inertia. --}}
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        {{-- Inertia mengganti bagian ini dengan halaman Vue yang sedang diminta. --}}
        @inertia

        {{-- Bootstrap bundle mengaktifkan interaksi seperti tombol navbar yang dapat dibuka-tutup. --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>