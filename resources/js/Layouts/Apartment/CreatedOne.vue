<template>
    <div class="createdOne">
        <form @submit.prevent="submitRegister" class="" >

            <label class="block">
                <span for="number" class="text-gray-700">Numero do apartamento*</span>
                <input id="number" type="text" v-model="form.number"
                :class="styleForm"
                >
                <div v-if="form.errors.number">{{ form.errors.number }}</div>
            </label>
            <PrimaryButton class="my-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Cadastra
            </PrimaryButton>
        </form>
    </div>
</template>
<script>
import {computed, defineComponent, ref} from 'vue'
import {useForm, router} from '@inertiajs/vue3'
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue'
import { useStore } from 'vuex'

export default defineComponent({
    components:{
        PrimaryButton
    },
    emits: ['created-apto'],
    setup(props, ctx){
        const store = useStore()
        const condominia = computed(()=> store.state.condominia)
        const styleForm = ref("block w-full px-4 rounded-md border-transparent  form-input")
        const form = useForm({
            number:"",
            condominia_id: condominia.value.block.condominia_id,
            block_id:condominia.value.block.id
        })
        const data = ref({
            number:'',

        })
        // const emit = defineEmits(['created-apto'])
        const submitRegister = () => {
            form.post(route('apartment.create'), {
                onSuccess:(e) => form.reset(),
                onError:() => styleForm.value = 'block w-full rounded-md px-4 border-red-700  form-input',
                onFinish:() => {
                    form.reset(),
                    setTimeout(() => {
                        router.reload(),
                        ctx.emit('created-apto')
                    }, 1000);
                }
            })
        }
        return{
            styleForm,
            condominia,
            form,
            data,
            submitRegister
        }
    }
})
</script>
