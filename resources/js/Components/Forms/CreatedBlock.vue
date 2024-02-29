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
                <div v-if="form.errors.name" class="font-medium text-red-700">{{ form.errors.name }}</div>
            </label>
        </div>
        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Cadastra
        </PrimaryButton>
   </form>
</template>

<script>
import {useForm, router} from '@inertiajs/vue3'
import {computed, defineComponent, ref} from 'vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import { useStore } from 'vuex';
// import Dialog from '@/Components/Dialog.vue';

export default defineComponent({
    components:{
        PrimaryButton
    },
    setup(){
        // const item = ref({...condominia})
        const store = useStore()
        const styleForm = ref("block w-full px-4 border-transparent rounded form-input")
        const id = computed(()=> store.state.condominia.id)
        const form = useForm({
            name:"",
            condominia_id: id.value
        })
        const submitRegister = () => {
            // form.condominia_id = condominia
            console.log(form)
            form.post(route('blocks.create'), {
                onSuccess:() => form.reset(),
                onError:() => styleForm.value = 'block w-full px-4 border-red-700 rounded form-input',
                onFinish:() => router.reload()
            })
        }

        return {
            id,
            form,
            styleForm,
            submitRegister
        }
    }
});

</script>
