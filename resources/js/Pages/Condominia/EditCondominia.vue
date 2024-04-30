<template>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <Head :title="condominia.name"/>
    <AuthenticatedLayout>
        <div class="flex justify-center p-6 md:max-w-5xl">
           Condominio - {{ condominia.name }}

        </div>
        <div class="flex justify-center">
            <div class="m-4">
                <InputLabel for="road" value="Rua"/>
                <TextInput
                    id="road"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.road"
                    required
                    autocomplete="road"
                ></TextInput>
            </div>
             <div class="m-4">
                <InputLabel for="number" value="Número"/>
                <TextInput
                    id="number"
                    type="number"
                    class="block w-full mt-1"
                    v-model="form.number"
                    required
                ></TextInput>
            </div>
            <div class="m-4">
                <InputLabel for="zip_code" value="CEP"/>
                <TextInput
                    id="zip_code"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.zip_code"
                    required
                ></TextInput>
                <div v-if="form.errors.zip_code">{{ form.errors.zip_code }}</div>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="m-4">
                <InputLabel for="city" value="Cidade"/>
                <TextInput
                    id="city"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.city"
                    required
                ></TextInput>
                <div v-if="form.errors.city">{{ form.errors.city }}</div>
            </div>
            <div class="m-4">
                <InputLabel for="state" value="Qual estado ?"/>
                <!-- <span for="genre" class="light:text-gray-700">Qual genero se idenfica ?</span> -->
                <select v-model="form.state" :class="styleForm">
                    <option v-for="item in states" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
                <div v-if="form.errors.state">{{ form.errors.genre }}</div>
            </div>
            <div class="m-4">
                <InputLabel for="district" value="Bairro"/>
                <TextInput
                    id="district"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.district"
                    required
                ></TextInput>
                <div v-if="form.errors.district">{{ form.errors.district }}</div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
<script>
import { Head, useForm, router} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { computed, onMounted, ref } from 'vue';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import DangerButton from '../../Components/DangerButton.vue';
import { useStore } from 'vuex';
import Dialog from '../../Components/Dialog.vue';
import { Inertia} from '@inertiajs/inertia'
import InputLabel from '../../Components/Forms/InputLabel.vue'
import TextInput from '../../Components/Forms/TextInput.vue'

export default{
    components:{
        Head,
        AuthenticatedLayout,
        PrimaryButton,
        Dialog,
        DangerButton,
        InputLabel,
        TextInput
    },
    props:{
        condominia:{type:Object},
        flash:{type:Object}
    },

    setup(){
        const styleForm = "px-4 border-transparent rounded form-input text-black  mt-1"
        const form = useForm({
            road:"",
            state:"",
            number:"",
            state:""
        })
        const states = [
            {id:0, name:"Selecioner o estado"},
            {id:1, name:"Rio de Janeiro"},
            {id:2, name:"São Paulo"},
            {id:3, name:"Bahia"},
            {id:4, name:"Rio Grande do Sul"}
        ]
        return{form,states, styleForm}
    }

    // setup(){
    //     const submit = (id) => {
    //         alert(id)
    //         if(confirm("are you sure you want to delete this user?"))
    //         {
    //             $this.$inertia.delete(`users/${id}`)
    //         }
    //     }

    //     return {
    //         submit
    //     }
    // }

}
</script>
<style>

</style>
