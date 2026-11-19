<script setup>
// Head mengatur judul halaman; Link/router menangani navigasi dan aksi Inertia.
import { Head, Link, router, usePage } from '@inertiajs/vue3';

// Daftar post dikirim oleh controller untuk ditampilkan pada tabel.
defineProps({
    posts: Array
});

// usePage memberi akses ke props global seperti pengguna yang sedang login.
const page = usePage();
</script>

<template>
    <!-- Halaman daftar post berisi navigasi, tombol tambah, dan tabel aksi CRUD. -->
    <Head title="Data Posts" />

    <div class="posts-page">
        <nav class="navbar navbar-dark bg-dark posts-navbar">
            <div class="posts-container d-flex align-items-center justify-content-between">
                <Link class="navbar-brand fw-bold mb-0" href="/posts">LARAVEL + VUE + INERTIA.JS</Link>
                <!-- Informasi pengguna dan tombol logout hanya tampil jika sesi pengguna tersedia. -->
                <div v-if="page.props.auth?.user" class="d-flex align-items-center gap-3">
                    <span class="user-greeting">Halo, <strong>{{ page.props.auth.user.name }}</strong></span>
                    <button class="btn btn-outline-danger btn-sm logout-button" type="button" @click="router.post('/logout')">
                        LOGOUT
                    </button>
                </div>
            </div>
        </nav>

        <main class="posts-container posts-content">
            <!-- Membuka formulir untuk menambahkan post baru. -->
            <Link href="/posts/create" class="btn btn-primary add-button">TAMBAH DATA</Link>

            <div class="card posts-table-card">
                <div class="card-body">
                    <table class="table align-middle mb-0">
                        <colgroup>
                            <col class="title-column">
                            <col class="content-column">
                            <col class="actions-column">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">TITLE</th>
                                <th scope="col">CONTENT</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Setiap baris mewakili satu post dengan tautan edit dan aksi hapus. -->
                            <tr v-for="post in posts" :key="post.id">
                                <td>{{ post.title }}</td>
                                <td>{{ post.content }}</td>
                                <td>
                                    <Link :href="`/posts/${post.id}/edit`" class="btn btn-sm btn-primary me-2">EDIT</Link>
                                    <Link :href="`/posts/${post.id}`" method="delete" as="button" class="btn btn-sm btn-danger">DELETE</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
.posts-page {
    min-height: 100vh;
    background: #f6f7f9;
}

.posts-navbar {
    min-height: 54px;
    padding: 4px 0;
}

.posts-container {
    width: min(100% - 32px, 1072px);
    margin: 0 auto;
}

.posts-navbar .navbar-brand {
    font-size: 16px;
}

.user-greeting {
    color: #d1d5db;
    font-size: 12px;
}

.user-greeting strong {
    color: #f4c542;
}

.logout-button {
    border-radius: 20px;
    font-size: 11px;
    padding: 4px 14px;
}

.posts-content {
    padding-top: 42px;
}

.add-button {
    display: inline-block;
    margin-bottom: 16px;
    padding: 7px 12px;
    font-size: 13px;
}

.posts-table-card {
    overflow-x: auto;
    border: 0;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgb(0 0 0 / 10%);
}

.posts-table-card .card-body {
    padding: 12px 14px;
}

.posts-table-card th {
    padding: 9px 7px;
    color: #343a40;
    font-size: 13px;
    font-weight: 700;
}

.posts-table-card td {
    padding: 12px 7px;
}

.posts-table-card .title-column {
    width: 23%;
}

.posts-table-card .content-column {
    width: 31%;
}

.posts-table-card .actions-column {
    width: 46%;
}

.posts-table-card td:last-child {
    text-align: center;
}

@media (max-width: 575px) {
    .posts-navbar .navbar-brand {
        font-size: 13px;
    }

    .user-greeting {
        display: none;
    }

    .posts-content {
        padding-top: 24px;
    }

    .posts-table-card {
        min-width: 0;
    }
}
</style>