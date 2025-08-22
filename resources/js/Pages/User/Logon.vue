<template>
    <div class="auth-background relative min-w-screen min-h-screen flex justify-center items-center p-10 bg-no-repeat bg-right bg-cover overflow-x-hidden"
        :style="{ backgroundImage: `url('${bgSvg}')` }">
        <div class="login-wrapper absolute top-0 bottom-0 left-0 w-1/2 h-full flex flex-col p-10 bg-transparent">
            <div class="header flex justify-start justify-self-start top-0">
                <img class="logo w-56" src="@/assets/purple_horizontal_logo.png" alt="Logo">
            </div>
            <div class="body flex grow justify-center items-center px-4 py-0">
                <div class="w-3/5 h-5/6">
                    <span class="lead font-bold font-poppins text-gray-500">Comece aqui sua jornada para ajudar
                        pessoas!</span>
                    <h1 class="main-title font-bold font-poppins text-purple-800 text-3xl pb-8">Crie Uma Conta!
                    </h1>

                    <form class="login-form w-full" @submit.prevent="submit" method="post">
                        <div class="flex flex-col items-center w-full gap-5">
                            <div class="form-group relative w-full">
                                <input
                                    class="h-[50px] p-2 font-md text-purple-800 bg-purple-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    v-model="form.name" type="text" id="name" name="name" required>
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-purple-50 pointer-events-none"
                                    for="email">Nome</label>
                            </div>
                            <div class="form-group relative w-full">
                                <input
                                    class="h-[50px] p-2 font-md text-purple-800 bg-purple-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    v-model="form.email" type="email" id="email" name="email" required>
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-purple-50 pointer-events-none"
                                    for="password">E-mail</label>
                            </div>
                            <div class="form-group relative w-full">
                                <input
                                    class="h-[50px] p-2 font-md text-purple-800 bg-purple-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    v-model="form.password" type="password" id="password" name="password" required>
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-purple-50 pointer-events-none"
                                    for="password">Senha</label>
                            </div>
                            <div class="form-group relative w-full">
                                <input
                                    class="h-[50px] p-2 font-md text-purple-800 bg-purple-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    v-model="form.password_confirmation" type="password" id="password_confirmation"
                                    name="password_confirmation" required>
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-purple-50 pointer-events-none"
                                    for="password">Confirmar Senha</label>
                            </div>
                            <button type="submit"
                                class="w-full h-[50px] p-2 font-lg font-bold text-purple-50 bg-purple-800 rounded-md cursor-pointer hover:bg-purple-700 transition">Registrar</button>
                        </div>
                    </form>

                    <div class="separator flex items-center my-6">
                        <div class="flex-grow border-t-2 border-gray-500"></div>
                        <span class="mx-4 text-gray-500 text-sm">ou registre-se com</span>
                        <div class="flex-grow border-t-2 border-gray-500"></div>
                    </div>

                    <div class="social-btn flex justify-center gap-4">
                        <button
                            class="border-2 border-gray-500 rounded-lg w-28 h-14 flex items-center justify-center cursor-pointer">
                            <i class="fa-brands fa-instagram text-3xl text-purple-800"></i>
                        </button>
                        <button
                            class="border-2 border-gray-500 rounded-lg w-28 h-14 flex items-center justify-center cursor-pointer">
                            <i class="fa-brands fa-google text-3xl text-purple-800"></i>
                        </button>
                        <button
                            class="border-2 border-gray-500 rounded-lg w-28 h-14 flex items-center justify-center cursor-pointer">
                            <i class="fa-brands fa-apple text-3xl text-purple-800"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
input:-webkit-autofill,
input:-webkit-autofill:focus,
input:-webkit-autofill:hover,
input:-webkit-autofill:active {
    -webkit-box-shadow: 0 0 0 50px #faf5ff inset !important;
    box-shadow: 0 0 0 50px #faf5ff inset !important;
    -webkit-text-fill-color: #6d28d9 !important;
}
</style>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import EmptyLayout from '../../Layouts/EmptyLayout.vue'
import bgSvg from '../../../assets/bg2.svg'

defineOptions({
    layout: EmptyLayout,
})

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

function submit() {
    form.post('/auth/logon')
}
</script>
