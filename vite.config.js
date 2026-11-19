import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// Konfigurasi Vite untuk membangun aset frontend Laravel dan mengaktifkan kompilasi komponen Vue.
export default defineConfig({
    plugins: [
        // Plugin Laravel menentukan entry JavaScript dan memuat ulang halaman saat file berubah.
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        // Plugin Vue mengatur pemrosesan aset yang direferensikan di template komponen.
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
