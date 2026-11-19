<script setup>
// computed menghitung status pesan berdasarkan status yang dikirim dari server.
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Status dipakai untuk memberi tahu pengguna bahwa email verifikasi sudah dikirim.
const props = defineProps({
    status: {
        type: String,
    },
});

// Form kosong karena endpoint pengiriman ulang hanya memerlukan pengguna yang sedang login.
const form = useForm({});

const submit = () => {
    // Meminta server mengirim ulang tautan verifikasi email.
    form.post(route('verification.send'));
};

// Pesan sukses ditampilkan hanya untuk status pengiriman ulang yang dikenali.
const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <!-- Halaman instruksi verifikasi email dan tindakan kirim ulang atau logout. -->
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
            we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <!-- Konfirmasi ini hanya muncul setelah server berhasil mengirim ulang email. -->
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400" v-if="verificationLinkSent">
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <!-- Form mengirim permintaan kirim ulang; tombol dinonaktifkan ketika request berjalan. -->
        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >Log Out</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
