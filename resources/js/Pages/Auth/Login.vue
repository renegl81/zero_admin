<template>
    <head :title="  __('auth.login.title')" />
    <div class="grid min-h-screen grid-cols-1 sm:grid-cols-2" id="login">
        <!-- Left side -->
        <login-left-splash />

        <!-- Right side -->
        <div class="flex items-center justify-center panel">
            <div class="flex flex-col w-full p-6 sm:p-0 content sm:w-1/2">
                <el-alert v-if="$page.props.flash.error" :title="__($page.props.flash.error)" type="error" />
                <div>
                    <img
                        class="mb-6 logo"
                        alt="logo"
                        src="/images/logo.png"
                    />
                </div>
                <!-- Title -->
                <span class="text-gray-900 title">
                    {{ __("auth.login.title") }}
                </span>

                <!-- Validators -->
                <jet-validation-errors class="mb-8" />

                <form @submit.prevent="submit" class="flex flex-col mt-8 space-y-8">
                    <!-- Email -->
                    <div>
                        <jet-label
                            class="label"
                            for="email"
                            :value="__('auth.login.email')"
                        />
                        <input
                            id="email"
                            type="email"
                            class="block w-full mt-1 border border-gray-200 rounded-lg "
                            v-model="form.email"
                            required
                            autofocus
                        />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <jet-label
                                class="label"
                                for="password"
                                :value="__('auth.login.password')"
                            />
                            <!-- Forgot password link -->
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="password-forgot"
                            >
                                {{ __("auth.login.passwordForgot") }}
                            </Link>
                        </div>
                        <div class="relative flex items-center">
                            <input
                                id="password"
                                :type="passwordType"
                                class="block w-full pr-12 mt-1 border border-gray-200 rounded-lg"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <!-- Toggle password visibility -->
                            <img
                                @click="togglePasswordType()"
                                v-show="isPasswordVisible"
                                src="/images/icons/eye.svg"
                                class="absolute right-4"
                                alt="toggle password visibility"/>
                            <img
                                @click="togglePasswordType()"
                                v-show="!isPasswordVisible"
                                src="/images/icons/eye-off.svg"
                                class="absolute right-4"
                                alt="toggle password visibility"/>
                        </div>
                    </div>

                    <!-- Login button -->
                    <button
                        :class="[
                            'button p-2 text-white bg-blue-700 text-center rounded-lg',
                            { 'opacity-25': form.processing },
                        ]"
                        :disabled="form.processing"
                    >
                       {{  __("auth.login.button") }}
                    </button>

                    <!-- New account link -->
                    <Link
                        :href="route('register')"
                        class="text-center new-account password-forgot"
                    >
                    </Link>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import {Head, Link, usePage} from "@inertiajs/inertia-vue3";

import LoginLeftSplash from "../../components/LoginLeftSplash.vue";
import {ref, computed} from "vue";
import { useForm } from "@inertiajs/inertia-vue3";


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const passwordType = ref("password");
const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const isPasswordVisible = computed(() => passwordType.value === 'password');


const submit = () => {
    form
        .transform((data) => ({
            ...data,
            remember: form.remember ? "on" : "",
        }))
        .post(route("login"), {
            onFinish: () => form.reset("password"),
        });
};
const togglePasswordType = () => {
    if (passwordType.value === "password") {
        passwordType.value = "text";
    } else {
        passwordType.value = "password";
    }
};
</script>
