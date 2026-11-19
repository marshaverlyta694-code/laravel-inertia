// Memuat konfigurasi HTTP dan stylesheet global sebelum aplikasi Vue dijalankan.
import './bootstrap';
import '../css/app.css';

// Helper Vue dan Inertia untuk membuat aplikasi satu halaman (SPA).
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Nama aplikasi dari .env dipakai pada judul tab; gunakan "Laravel" jika belum diatur.
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Inisialisasi Inertia: menentukan judul, memuat halaman Vue, dan memasang plugin.
createInertiaApp({
    // Menambahkan nama aplikasi pada judul setiap halaman.
    title: (title) => `${title} - ${appName}`,
    // Mencari komponen halaman berdasarkan nama yang dikirim dari Laravel.
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        // Membuat aplikasi Vue, mendaftarkan plugin Inertia dan Ziggy, lalu memasangnya ke elemen HTML.
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    // Warna indikator progres yang tampil ketika navigasi Inertia berlangsung.
    progress: {
        color: '#4B5563',
    },
});
