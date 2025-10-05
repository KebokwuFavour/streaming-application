<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <!-- <AuthenticationCardLogo /> -->
            <a class="navbar-brand fw-bold fs-4 text-primary" href="#">
                <i class="bi bi-camera-reels-fill me-2"></i> Bunma
                <!-- <img src="logo.svg" alt="Bunma Logo" class="d-inline-block align-text-top text-center" style="height: 80px; width: 180px;" /> -->
            </a>
        </template>

        <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
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
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ms-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form> -->
    
    
        <form @submit.prevent="submit">
            <div class="mb-3">
                <InputLabel for="name" value="Name" class="form-label" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="text-danger mt-1" :message="form.errors.name" />
            </div>

            <div class="mb-3">
                <InputLabel for="email" value="Email" class="form-label" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    required
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
                    autocomplete="new-password"
                />
                <InputError class="text-danger mt-1" :message="form.errors.password" />
            </div>

            <div class="mb-3">
                <InputLabel for="password_confirmation" value="Confirm Password" class="form-label" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="form-control"
                    required
                    autocomplete="new-password"
                />
                <InputError class="text-danger mt-1" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mb-3">
                <div class="form-check">
                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required class="form-check-input" />
                    <label class="form-check-label ms-2" for="terms">
                        I agree to the
                        <!-- <a target="_blank" :href="route('terms.show')" class="text-decoration-underline small text-secondary">Terms of Service</a> -->
                        <a href="#" class="text-decoration-underline small text-info">Terms of Service</a>
                        and
                        <!-- <a target="_blank" :href="route('policy.show')" class="text-decoration-underline small text-secondary">Privacy Policy</a> -->
                        <a href="#" class="text-decoration-underline small text-info">Privacy Policy</a>
                    </label>
                </div>
                <InputError class="text-danger mt-1" :message="form.errors.terms" />
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <Link :href="route('login')" class="text-decoration-none small text-info">
                    Already registered?
                </Link>
                <PrimaryButton class="btn btn-info ms-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
