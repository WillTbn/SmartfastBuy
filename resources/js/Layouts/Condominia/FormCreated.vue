<template>
    <div class="form-created">
        <div class="flex justify-around mt-5">
            <info-button v-if="state == 'initial'" @click.prevent="state = 'created'">
                Cadastra Condominio
            </info-button>
        </div>
        <div class="container flex justify-center max-auto" v-if="state == 'created'">

            <form @submit.prevent="submitRegister" class="columns-2xs "  >
                <label class="block">
                    <span for="name" class="text-gray-700">Nome do condomínio *</span>
                    <input id="name" type="text" v-model="form.name"
                    :class="styleForm"
                    >
                    <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </label>
                <PrimaryButton class="m-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Cadastra
                </PrimaryButton>
                <green-button @click.prevent="state = 'initial'">
                    voltar
                </green-button>
            </form>
        </div>
    </div>
</template>
<script>
import {computed, defineComponent, ref} from 'vue'
import {useForm, router} from '@inertiajs/vue3'
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue'
import InfoButton from '../../Components/Buttons/InfoButton.vue'
import GreenButton from '../../Components/Buttons/GreenButton.vue'
import { useStore } from 'vuex'

export default defineComponent({
    components:{
        PrimaryButton,
        InfoButton,
        GreenButton
    },
    setup(){
        const store = useStore()
        const condominia = computed(()=> store.state.condominia)
        const styleForm = ref("block w-full px-4 rounded-md border-transparent  form-input")
        const state = ref('initial')
        const form = useForm({
            name:"",
        })
        // const emit = defineEmits(['created-apto'])
        const submitRegister = () => {
            form.post(route('condominia.create'), {
                onSuccess:(e) => {
                    form.reset(),
                    console.log(e.props)
                    // store.commit("condominia/setBlock", e.props.blocks)

                },
                onError:() => styleForm.value = 'block w-full rounded-md px-4 border-red-700  form-input',
                onFinish:() => {
                    form.reset(),
                    setTimeout(() => {
                        router.reload()
                    }, 1000);
                }
            })
        }
        return{
            state,
            styleForm,
            condominia,
            form,
            submitRegister
        }
    }
})
</script>
