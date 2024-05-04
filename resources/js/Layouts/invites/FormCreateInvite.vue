<template>
    <div class="flex justify-end">
        <!-- <danger-button class="ml-4" @click.prevent="$emit('closed')">

        </danger-button> -->
        <font-awesome-icon class="w-10 text-red-600 h-7" :icon="['fass', 'fa-window-close']"  @click.prevent="$emit('closed')"/>
    </div>
     <!-- <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" /> -->
    <form @submit.prevent="submitRegister" class="p-4 mx-auto mt-6 space-y-6 md:container darK:bg-ligth-800" >
      <!-- email class="grid grid-cols-3 grid-rows-3 gap-4"-->
        <div class="grid grid-cols-2 gap-2 ">
            <label class="block">
                <span for="name" class="text-gray-700">Nome*</span>
                <input id="name" type="text" v-model="form.name"
                :class="styleForm"
                >
                <msg-error v-if="form.errors.name" :message="form.errors.name"/>
                <!-- <div v-if="form.errors.name">{{ form.errors.name }}</div> -->
            </label>
            <label class="block">
                <span for="email" class="text-gray-700">Email*</span>
                <input id="email" type="text" v-model="form.email"
                :class="styleForm"
                >
                <msg-error v-if="form.errors.email" :message="form.errors.email"/>
            </label>
        </div>

        <div class="grid grid-cols-3 gap-3 mt-5">
            <label class="block">
                <span for="person" class="text-gray-700">CPF*</span>
                <input id="person" type="text" v-model="form.person"
                    :class="styleForm"
                >
                <msg-error v-if="form.errors.person" :message="form.errors.person"/>
            </label>
            <label class="block">
                <span for="birthday" class="text-gray-700">Data de Nascimento*</span>
                <input id="birthday" type="text" v-model="form.birthday"
                    :class="styleForm"
                >
                <!-- <div v-if="form.errors.birthday">{{ form.errors.birthday }}</div> -->
            </label>
            <label class="block">
                <span for="genre" class="text-gray-700">Qual genero se idenfica ?</span>
                <select v-model="form.genre" class="block w-full mt-1 border-transparent rounded-md bg-gray">
                    <option v-for="item in getGenre" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
                <!-- <div v-if="form.errors.genre">{{ form.errors.genre }}</div> -->
            </label>


        </div>
        <div class="grid grid-cols-3 gap-3 mt-5">
            <label class="block">
                <span for="telephone" class="text-gray-700">Telefone</span>
                <input id="telephone" type="text" v-model="form.telephone"
                    :class="styleForm"
                >
                <!--  <div v-if="form.errors.telephone">{{ form.errors.telephone }}</div> -->
            </label>
            <label class="block">
                <span for="phone" class="text-gray-700">Celular</span>
                <input id="phone" type="text" v-model="form.phone"
                    :class="styleForm"
                >
                <!--  <div v-if="form.errors.phone">{{ form.errors.phone }}</div> -->
            </label>
            <label class="block">
                <span for="notifications" class="text-gray-700">Receber notitificações ?*</span>
                <select v-model="form.notifications" class="block w-full mt-1 border-transparent rounded-md bg-gray">
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
const styleForm = ref("block w-full px-4 bg-zinc-400 rounded form-input")
import {useForm} from '@inertiajs/vue3'
import {ref, computed, defineComponent} from 'vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import condominia from '../../Store/condominia';
import MsgError from '../../Components/Forms/MsgError.vue';
import useNotify from '../../composables/useNotify'
// import Dialog from '@/Components/Dialog.vue';
defineComponent({
    MsgError,
    DangerButton
})
const props = defineProps({
    condominia_id:{
        type:Number
    },
    apartment_id:{type:Number}
})
// defineEmits(['closed'])
const {errorNotify, multError} = useNotify()
const emit = defineEmits(['closed'])
const submitRegister = () => {
    form.post(route('invites.create'), {
        onSuccess:() => {
            form.reset(),
            emit('closed')
        },
        onError:(e) =>  multError(e)
        // onError:(e) =>{
        //     for(const key in e){
        //         errorNotify(e[key])
        //     }
        // },
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
    {id:2, value:"refused", name:"não"}
]
const dataEx = ref({
    person:"teste",
    birthday:"stes",
    apartment_id:props.apartment_id,
    genre:"",
    notifications:"",
    telephone:"",
    phone:"",
})

const form = useForm({
    name:"",
    email:"",
    person:"",
    birthday:"",
    apartment_id:props.apartment_id,
    genre:"",
    notifications:"",
    telephone:"",
    phone:"",
})
const Apartments = computed(() => {
    dataEx.value.condominia_id ? 'valor1' : 'valor2'
})

</script>
<style scoped>

</style>
