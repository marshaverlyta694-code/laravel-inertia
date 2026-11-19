<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Menerima data posts dari Controller
defineProps({
    posts: Array
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                
                <!-- Box bawaan Dashboard kamu -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div>

                <!-- Bagian Tambah Data & Tabel (Di bawahnya) -->
                <div>
                    <!-- Tombol Tambah Data -->
                    <div class="mb-4">
                        <Link 
                            href="/posts/create" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow uppercase text-sm inline-block">
                            TAMBAH DATA
                        </Link>
                    </div>

                    <!-- Tabel Data -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b dark:border-gray-700 uppercase text-sm font-bold text-gray-700 dark:text-gray-300">
                                    <th class="py-3 px-4">TITLE</th>
                                    <th class="py-3 px-4">CONTENT</th>
                                    <th class="py-3 px-4 text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts" :key="post.id" class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <td class="py-3 px-4">{{ post.title }}</td>
                                    <td class="py-3 px-4">{{ post.content }}</td>
                                    <td class="py-3 px-4 text-center space-x-2">
                                        <Link 
                                            :href="`/posts/${post.id}/edit`" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1.5 px-3 rounded uppercase">
                                            EDIT
                                        </Link>
                                        <Link 
                                            :href="`/posts/${post.id}`" 
                                            method="delete" 
                                            as="button" 
                                            class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1.5 px-3 rounded uppercase">
                                            DELETE
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="!posts || posts.length === 0">
                                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>