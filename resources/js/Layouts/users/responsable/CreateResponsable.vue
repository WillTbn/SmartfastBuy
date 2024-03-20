<template>
    <div class="create-reponsable bg-slate-900">
        <div class="grid justify-center text-center m-3">
            <h4>
                Adicionar responsavel para o condominio
            </h4>
            <p class="font-bold">
                {{condominia.name}}
            </p>

        </div>
        <form @submit.prevent="submitRegister" class="p-4 mx-auto mt-6 space-y-6 md:container" >
        <!-- email class="grid grid-cols-3 grid-rows-3 gap-4"-->
            <div class="grid grid-cols-3 gap-4">
                <label class="block">
                    <span for="name" class="light:text-gray-700">Nome*</span>
                    <input id="name" type="text" v-model="form.name"
                    :class="styleForm"
                    >
                    <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </label>
                <label class="block">
                    <span for="email" class="light:text-gray-700">Email*</span>
                    <input id="email" type="email" v-model="form.email"
                    :class="styleForm"
                    >
                    <div v-if="form.errors.email">{{ form.errors.email }}</div>
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
            <div class="grid grid-cols-3 gap-3 mt-5">
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
            <div class="grid grid-cols-3 gap-3 mt-5">
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
    </div>
</template>
<script>
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import MsgError from '@/Components/Forms/MsgError.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import {defineComponent, computed,ref} from 'vue';
import {useStore} from 'vuex';



export default defineComponent({
    components:{
        MsgError,
        PrimaryButton
    },
    setup(){
    const styleForm = ref("block w-full px-4 border-transparent rounded form-input text-black");
    const store = useStore()

    const condominia = computed(() =>  store.state.condominia.condominia)
    const submitRegister = () => {
        form.post(route('responsable.create'), {
            onSuccess:() => form.reset()
        })
    }
    const randomCaract = (value) => {
        let stringRandom = "";
        for (let i = 0; i < 2; i++) {
            const randomIndex = Math.floor(Math.random() * value.length);
            stringRandom += value[randomIndex];
        }
        return stringRandom;
    }
    const geradorPassword = () => {

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
        condominia_id:condominia.value.id
    })
        return{
            sendPassword,
            submitRegister,
            getGenre,
            notYes,
            condominia,
            form,
            styleForm
        }
    }
})
</script>
<style>

</style>
