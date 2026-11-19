<script setup>
// Layout dan helper Inertia/Vue untuk halaman edit post.
import Layout from '../../Layouts/App.vue'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

// Menerima post yang dipilih serta error validasi dari server.
const props = defineProps({
    post: Object,
    errors: Object
})

// Mengisi state form dengan data yang ada agar pengguna dapat mengubahnya.
const post = reactive({
    title: props.post.title,
    content: props.post.content
})

// Mengirim perubahan memakai method spoofing karena browser form tidak mengirim PUT secara langsung.
function updatePost() {
    router.post(`/posts/${props.post.id}`, {
        _method: 'PUT',
        title: post.title,
        content: post.content,
    })
}
</script>

<template>
    <!-- Form edit menampilkan nilai post saat ini dan kesalahan validasi dari server. -->
    <Layout>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h4>EDIT POST</h4>
                <hr>
                <form @submit.prevent="updatePost">
                    <div class="mb-3">
                        <label class="form-label">TITLE POST</label>
                        <input type="text" class="form-control" v-model="post.title" placeholder="Masukkan Title Post">
                        <div v-if="errors?.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CONTENT</label>
                        <textarea class="form-control" rows="5" v-model="post.content" placeholder="Masukkan Content Post"></textarea>
                        <div v-if="errors?.content" class="mt-2 alert alert-danger">
                            {{ errors.content }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-md shadow-sm me-2">UPDATE</button>
                        <button type="reset" class="btn btn-warning btn-md shadow-sm">RESET</button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>