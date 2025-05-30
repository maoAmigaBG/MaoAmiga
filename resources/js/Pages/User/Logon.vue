<template>
    <div class="logon-wrapper">
        <h1 class="logon-title">Registrar</h1>
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="name">Nome</label>
                <input v-model="form.name" type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input v-model="form.email" type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input v-model="form.password" type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input v-model="form.password_confirmation" type="password" id="password_confirmation"
                    name="password_confirmation" required>
            </div>
            <div v-if="Object.keys(errors).length" class="errors">
                <ul>
                    <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
                </ul>
            </div>
            <button type="submit" class="submit-btn">Registrar</button>
        </form>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import EmptyLayout from '../../Layouts/EmptyLayout.vue'

defineOptions({
    layout: EmptyLayout,
})

const { errors } = usePage().props

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

<style scoped>
* {
    font-family: 'Poppins', 'Arial'
}

.logon-wrapper {
    max-width: 400px;
    margin: 80px auto;
    padding: 32px 24px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
}

.logon-title {
    text-align: center;
    margin-bottom: 24px;
    font-size: 2rem;
    color: #6f42c1;
    font-weight: 700;
}

.form-group {
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 6px;
    color: #333;
    font-weight: 600;
}

input[type="email"],
input[type="password"],
input[type="text"] {
    padding: 8px 10px;
    border-radius: 5px;
    border: 1px solid #bbb;
    font-size: 1rem;
}

.submit-btn {
    width: 100%;
    padding: 10px 0;
    background: #6f42c1;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
}

.submit-btn:hover {
    background: #563d7c;
}

.errors {
    margin-bottom: 16px;
    color: #d32f2f;
    font-size: 0.96rem;
}

.errors ul {
    margin: 0;
    padding: 0;
    list-style: none;
}
</style>