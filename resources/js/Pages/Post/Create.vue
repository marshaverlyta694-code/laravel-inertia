<script setup>
// Layout menyediakan navbar dan wadah konsisten untuk halaman manajemen post.
import Layout from '../../Layouts/App.vue'
// errors berisi kesalahan validasi yang dikirim kembali oleh Laravel.
defineProps({
    errors: Object
})
// reactive membuat perubahan pada input tersimpan dan langsung tercermin di tampilan.
import { reactive } from 'vue'

// Router Inertia mengirim permintaan ke backend tanpa reload halaman penuh.
import { router } from '@inertiajs/vue3'

// Nilai awal data post baru sebelum pengguna mengisi formulir.
const post = reactive({
    title: '',
    content: ''
})
// Mengirim judul dan isi post baru untuk divalidasi lalu disimpan di server.
function storePost() {
    router.post('/posts', post)
}
</script>
<template>
    <!-- Halaman pembuatan post: input dihubungkan ke state dan error ditampilkan per kolom. -->
    <Layout>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h4>TAMBAH POST</h4>
                <hr>
                <!-- Mencegah submit HTML biasa agar pengiriman dikelola oleh Inertia. -->
                <form @submit.prevent="storePost">
                    <div class="mb-3">
                        <label class="form-label">TITLE POST</label>
                        <input type="text" class="form-control" v-model="post.title" placeholder="Masukkan Title Post">
                        <div v-if="errors?.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CONTENT</label>
                        <textarea class="form-control" rows="5" v-model="post.content"
                            placeholder="Masukkan Content Post"></textarea>
                        <div v-if="errors?.content" class="mt-2 alert alert-danger">
                            {{ errors.content }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-md shadow-sm me-2">SIMPAN</button>
                        <button type="reset" class="btn btn-warning btn-md shadow-sm">RESET</button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>
