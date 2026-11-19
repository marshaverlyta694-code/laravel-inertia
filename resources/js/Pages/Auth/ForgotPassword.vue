<script setup>
// Komponen untuk struktur form, pesan error, dan tombol.
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

// Status dari server ditampilkan setelah permintaan tautan reset diproses.
defineProps({
    status: {
        type: String,
    },
});

// Email dimasukkan pengguna lalu dikirim ke endpoint permintaan reset.
const form = useForm({
    email: '',
});

const submit = () => {
    // Route ini mengirim email berisi tautan reset kata sandi.
    form.post(route('password.email'));
};
</script>

<template>
    <!-- Form lupa kata sandi pada layout autentikasi pengunjung. -->
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <!-- Pesan sukses hanya muncul jika server mengirim status. -->
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <!-- Form dikirim tanpa reload; validasi email ditampilkan dekat kolomnya. -->
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
