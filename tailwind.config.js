// Memakai font sans-serif bawaan Tailwind dan plugin formulir.
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // File yang dipindai Tailwind untuk menemukan class CSS yang benar-benar digunakan.
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            // Menambahkan Figtree sebagai font sans-serif utama, dengan font fallback Tailwind.
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    // Plugin forms memberi gaya dasar konsisten untuk elemen formulir HTML.
    plugins: [forms],
};
