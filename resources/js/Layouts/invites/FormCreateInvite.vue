<template>
     <!-- <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" /> -->
     <form @submit.prevent="submitRegister" class="p-4 mx-auto mt-6 space-y-6 md:container" >
      <!-- email class="grid grid-cols-3 grid-rows-3 gap-4"-->
        <div class="grid grid-cols-3 gap-4">
            <label class="block">
                <span for="name" class="text-gray-700">Nome*</span>
                <input id="name" type="text" v-model="form.name"
                :class="styleForm"
                >
                <div v-if="form.errors.name">{{ form.errors.name }}</div>
            </label>
            <label class="block">
                <span for="email" class="text-gray-700">Email*</span>
                <input id="email" type="text" v-model="form.email"
                :class="styleForm"
                >
                <div v-if="form.errors.email">{{ form.errors.email }}</div>
            </label>
            <label class="block">
                <span for="permissions" class="text-gray-700">Qual condominio ?*</span>
                <select v-model="dataEx.condominia_id" class="block w-full mt-1 border-transparent rounded-md bg-gray">
                    <option v-for="item in condominia" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
                <!-- <div v-if="form.errors.role_id">{{ form.errors.condominia }}</div> -->
            </label>

        </div>

        <div class="grid grid-cols-4 gap-4 mt-5">
            <label class="block">
                <span for="person" class="text-gray-700">CPF*</span>
                <input id="person" type="text" v-model="dataEx.person"
                    :class="styleForm"
                >
                <div v-if="form.errors.person">{{ form.errors.person }}</div>
            </label>
            <label class="block">
                <span for="birthday" class="text-gray-700">Data de Nascimento*</span>
                <input id="birthday" type="text" v-model="dataEx.birthday"
                    :class="styleForm"
                >
                <!-- <div v-if="form.errors.birthday">{{ form.errors.birthday }}</div> -->
            </label>
            <label class="block">
                <span for="genre" class="text-gray-700">Qual genero se idenfica ?</span>
                <select v-model="dataEx.genre" class="block w-full mt-1 border-transparent rounded-md bg-gray">
                    <option v-for="item in getGenre" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
                <!-- <div v-if="form.errors.genre">{{ form.errors.genre }}</div> -->
            </label>


        </div>
        <div class="grid grid-cols-4 gap-4 mt-5">
            <label class="block">
                <span for="telephone" class="text-gray-700">Telefone</span>
                <input id="telephone" type="text" v-model="dataEx.telephone"
                    :class="styleForm"
                >
                <!--  <div v-if="form.errors.telephone">{{ form.errors.telephone }}</div> -->
            </label>
            <label class="block">
                <span for="phone" class="text-gray-700">Celular</span>
                <input id="phone" type="text" v-model="dataEx.phone"
                    :class="styleForm"
                >
                <!--  <div v-if="form.errors.phone">{{ form.errors.phone }}</div> -->
            </label>
            <label class="block">
                <span for="notifications" class="text-gray-700">Receber notitificações ?*</span>
                <select v-model="dataEx.notifications" class="block w-full mt-1 border-transparent rounded-md bg-gray">
                    <option v-for="item in notYes" :key="item.id" :value="item.value">
                        {{ item.name }}
                    </option>
                </select>
                <!--  <div v-if="form.errors.notifications">{{ form.errors.notifications }}</div> -->
            </label>
        </div>
        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Cadastra
        </PrimaryButton>

    </form>
</template>

<script setup>
const styleForm = "block w-full px-4 border-transparent rounded form-input"
import {useForm} from '@inertiajs/vue3'
import {ref} from 'vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
// import Dialog from '@/Components/Dialog.vue';


defineProps({
    condominia:{
        type:Array
    },
})
const submitRegister = () => {
    form.post(route('invites.create'), {
        onSuccess:() => form.reset()
    })
}

const getGenre = [
    {id:1, name:"Homem"},
    {id:2, name:"Mulher"},
    {id:3, name:"LGBT"},
    {id:4, name:"não informar"}
]
const notYes = [
    {id:1, value:"accepted", name:"sim"},
    {id:2, value:"recused", name:"não"}
]
const dataEx = ref({
    person:"tete",
    birthday:"",
    condominia_id:"",
    genre:"",
    notifications:"",
    telephone:"",
    phone:"",
})
const form = useForm({
    name:"",
    email:"",
    vebdi:"dsdsjdhj",
    data:dataEx.value
})
</script>
