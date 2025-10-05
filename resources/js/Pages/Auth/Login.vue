<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <!-- <AuthenticationCardLogo /> -->
            <a class="navbar-brand fw-bold fs-4 text-info" href="#">
                <i class="bi bi-camera-reels-fill me-2"></i> Bunma
                <!-- <img src="logo.svg" alt="Bunma Logo" class="d-inline-block align-text-top text-center" style="height: 80px; width: 180px;" /> -->
            </a>
        </template>

        <!-- <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form> -->

        <div v-if="status" class="alert alert-success mb-4 py-2 px-3 text-center">
            {{ status }}
        </div>
        <form @submit.prevent="submit">
            <div class="mb-3">
                <InputLabel for="email" value="Email" class="form-label" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="text-danger mt-1" :message="form.errors.email" />
            </div>

            <div class="mb-3">
                <InputLabel for="password" value="Password" class="form-label" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="form-control"
                    required
                    autocomplete="current-password"
                />
                <InputError class="text-danger mt-1" :message="form.errors.password" />
            </div>

            <div class="mb-3 form-check">
                <Checkbox v-model:checked="form.remember" name="remember" class="form-check-input" id="remember" />
                <label class="form-check-label ms-2" for="remember">
                    Remember me
                </label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <!-- <div class=""> -->
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-decoration-none small text-info"
                    >
                        Forgot your password?
                    </Link>
                    <!-- <br>
                    <Link
                        v-if="canResetPassword"
                        :href="route('register')"
                        class="text-decoration-none small"
                    >
                        Not yet Registered?
                    </Link> -->
                <!-- </div> -->
                <PrimaryButton
                    class="btn btn-info ms-auto"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>

            <div class="text-center mt-4">
                <Link
                        v-if="canResetPassword"
                        :href="route('register')"
                        class="text-decoration-underline text-info small"
                    >
                        Not yet Registered?
                    </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
