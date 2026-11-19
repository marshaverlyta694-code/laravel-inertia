<script setup>
// Komponen logo dan Link digunakan pada area autentikasi yang belum login.
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Layout sederhana untuk login, pendaftaran, dan halaman autentikasi lainnya. -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <!-- Logo mengarahkan pengguna kembali ke halaman utama. -->
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <!-- Slot menjadi tempat formulir autentikasi dari halaman yang memakai layout ini. -->
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
