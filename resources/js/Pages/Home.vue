<template>
    <!-- <header class="flex w-screen px-4 py-5 bg-red-500 justify-content align-center">
        <h1 class="text-4xl font-bold">Olá Tailwind</h1>
        <img src="/logo-sfb.png" alt="Logotipo">
        {{user}}
    </header> -->
    <guestLayout>
        <form @submit.prevent="sendLogin" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                    E-mail
                </label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="username"
                    type="email"
                    placeholder="exemplo@exemplo.com.br"
                    v-model="form.email"
                >
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                    Password
                </label>
                <input
                    v-model="form.password"
                    class="w-full px-3 py-2 mb-3 leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    id="password"
                    type="password"
                    placeholder="******************"
                >
                <p class="text-xs italic text-red-500">Please choose a password.</p>
            </div>
            <div class="mb-6">
                <button
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"

                >
                Entrar
                </button>
            </div>
        </form>
    </guestLayout>
</template>
<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

import guestLayout from '../Layouts/guestLayout.vue'
defineProps({
    user: String
})
const form = ref({
    email: '',
    password: ''
})
// const send = useForm("getparams", {...form.value})
const sendLogin = ()=>{
   router.post('/auth', {...form.value})
    // send.post('Auth', {...send})
}
</script>