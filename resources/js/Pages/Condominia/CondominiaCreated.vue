<template>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <Head title="Cadastra condominio"/>
    <AuthenticatedLayout>
        <form-created-condominia/>
    </AuthenticatedLayout>
</template>
<script>
import { Head, useForm, router} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { computed, defineComponent, onMounted, ref } from 'vue';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import DangerButton from '../../Components/DangerButton.vue';
import Dialog from '../../Components/Dialog.vue';
import InputLabel from '../../Components/InputLabel.vue'
import TextInput from '../../Components/TextInput.vue'
import FormCreatedCondominia from '../../Layouts/Condominia/FormCreatedCondominia.vue';


export default defineComponent({
    components:{
        Head,
        AuthenticatedLayout,
        PrimaryButton,
        Dialog,
        DangerButton,
        InputLabel,
        TextInput,
        FormCreatedCondominia
    },
    props:{

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

})
</script>
<style>

</style>
