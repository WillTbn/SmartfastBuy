<template>
    <!-- <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" /> -->
    <form @submit.prevent="submitRegister" class="mx-auto max-w-7xl sm:px-6 lg:px-8 md:max-w-5xl" >
      <!-- email class="grid grid-cols-3 grid-rows-3 gap-4"-->
        <div class="grid grid-cols-3 gap-4">
            <label class="block">
                <input-label value="Nome"/>
                <!-- <span for="name" class="light:text-gray-700">Nome*</span> -->
                <!-- <input id="name" type="text" v-model="form.name"
                :class="styleForm"
                > -->
                <text-input id="name" v-model="form.name"
                    :class="styleForm"/>
                <div v-if="form.errors.name">{{ form.errors.name }}</div>
            </label>
            <label class="block">
                <span for="email" class="light:text-gray-700">Email*</span>
                <input id="email" type="email" v-model="form.email"
                :class="styleForm"
                >
                <div v-if="form.errors.email">{{ form.errors.email }}</div>
            </label>
            <label class="block">
                <span for="permissions" class="light:text-gray-700">Qual a permissão?*</span>
                <select v-model="form.role_id" :class="styleForm">
                    <option v-for="item in roles" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
                <div v-if="form.errors.role_id">{{ form.errors.role_id }}</div>
            </label>

        </div>
        <div class="grid grid-cols-3 gap-5 mt-5">
            <label class="block">
                <span for="password" class="light:text-gray-700">password*</span>
                <input id="password" type="password" v-model="form.password"
                :class="styleForm"
                >

            </label>
            <label class="block">
                <span for="password_confirmation" class="light:text-gray-700">Password confirm*</span>
                <input id="password_confirmation" type="password" v-model="form.password_confirmation"
                :class="styleForm"
                >
            </label>
            <div v-if="form.errors.password">{{ form.errors.password }}</div>
            <button
                style=" margin: auto;"
                @click.prevent="sendPassword"
                class="p-2 font-extrabold text-white rounded-sm bg-sky-500 hover:bg-sky-600"
            >
                gerar Senha
            </button>
        </div>
        <div class="grid grid-cols-4 gap-4 mt-5">
            <label class="block">
                <span for="person" class="light:text-gray-700">CPF*</span>
                <input id="person" type="text" v-model="form.person"
                    :class="styleForm"
                >
                <div v-if="form.errors.person">{{ form.errors.person }}</div>
            </label>
            <label class="block">
                <span for="birthday" class="light:text-gray-700">Data de Nascimento*</span>
                <input id="birthday" type="text" v-model="form.birthday"
                    :class="styleForm"
                >
                <div v-if="form.errors.birthday">{{ form.errors.birthday }}</div>
            </label>
            <label class="block">
                <span for="genre" class="light:text-gray-700">Qual genero se idenfica ?</span>
                <select v-model="form.genre" :class="styleForm">
                    <option v-for="item in getGenre" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
                <div v-if="form.errors.genre">{{ form.errors.genre }}</div>
            </label>


        </div>
        <div class="grid grid-cols-4 gap-4 mt-5">
            <label class="block">
                <span for="telephone" class="light:text-gray-700">Telefone</span>
                <input id="telephone" type="text" v-model="form.telephone"
                    :class="styleForm"
                >
                <div v-if="form.errors.telephone">{{ form.errors.telephone }}</div>
            </label>
            <label class="block">
                <span for="phone" class="light:text-gray-700">Celular</span>
                <input id="phone" type="text" v-model="form.phone"
                    :class="styleForm"
                >
                <div v-if="form.errors.phone">{{ form.errors.phone }}</div>
            </label>
            <label class="block">
                <span for="notifications" class="light:text-gray-700">receber notitificações ?*</span>
                <select v-model="form.notifications" :class="styleForm">
                    <option v-for="item in notYes" :key="item.id" :value="item.value">
                        {{ item.name }}
                    </option>
                </select>
                <div v-if="form.errors.notifications">{{ form.errors.notifications }}</div>
            </label>
        </div>
        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Cadastra
        </PrimaryButton>

    </form>

</template>
<script setup>
const styleForm = "block w-full px-4 border-transparent rounded form-input text-black"
import {useForm} from '@inertiajs/vue3'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue'
import TextInput from '@/Components/Forms/TextInput.vue'
// import Dialog from '@/Components/Dialog.vue';


defineProps({
    roles:{
        type:Array
    },
})
const submitRegister = () => {
    form.post(route('users.create'), {
        onSuccess:() => form.reset()
    })
}
function randomCaract(value){
    let stringRandom = "";
    for (let i = 0; i < 2; i++) {
        const randomIndex = Math.floor(Math.random() * value.length);
        stringRandom += value[randomIndex];
    }
    return stringRandom;
}
function geradorPassword(){

    const charset = [
        'abcdefghijklmnopqrstuvwxyz',
        '!@#$%¨&*()_+=-',
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        '0123456789',
    ]
    let password = "";
    for (let i = 0; i < charset.length; i++) {
        password += randomCaract(charset[i]);
    }
    return password;
}
const getGenre = [
    {id:1, name:"Homem"},
    {id:2, name:"Mulher"},
    {id:3, name:"LGBTQQICAAPF2K+"},
    {id:4, name:"não informar"}
]
const notYes = [
    {id:1, value:"accepted", name:"sim"},
    {id:2, value:"refused", name:"não"}
]
const sendPassword = () => {
    let data = geradorPassword()
    form.password = data
    form.password_confirmation = data
};
const form = useForm({
    name:"",
    role_id:"",
    email:"",
    password:"",
    password_confirmation:"",
    remember:false,
    notifications: "",
    person: "",
    telephone: "",
    genre: "",
    birthday:"",
    phone:"",
})
</script>
