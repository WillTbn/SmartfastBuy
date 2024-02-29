<template>
    <div class="created-mult">
        <form @submit.prevent="submitRegister" class="" >

            <label class="block">
                <span for="number" class="text-gray-700">Número do primeiro apartamento*</span>
                <input id="number" type="text" v-model="form.apartment_start"
                :class="styleForm"
                >
                <div v-if="form.errors.apartment_start">{{ form.errors.apartment_start }}</div>
            </label>
            <label class="block">
                <span for="number_finally" class="text-gray-700">Número do ultimo apartamento*</span>
                <input id="number_finally" type="text" v-model="form.apartment_finally"
                :class="styleForm"
                >
                <div v-if="form.errors.apartment_finally">{{ form.errors.apartment_finally }}</div>
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
    setup(props,ctx){
        // const emit = defineEmits(['created-apto'])
        const store = useStore()
        const condominia = computed(()=> store.state.condominia)
        const styleForm = ref("block w-full px-4 rounded-md border-transparent  form-input")
        const form = useForm({
            apartment_start:"",
            apartment_finally:"",
            condominia_id: condominia.value.block.condominia_id,
            block_id:condominia.value.block.id
        })

        const submitRegister = () => {
            console.log(form.value)
            form.post(route('blocks.floorsBlock'), {
                onSuccess:(e) => {
                    form.reset(),
                    console.log(e.props)
                    // store.commit("condominia/setBlock", e.props.blocks)

                },
                onError:() => styleForm.value = 'block w-full rounded-md px-4 border-red-700  form-input',
                onFinish:() => {
                    form.reset(),
                    setTimeout(() => {
                        router.reload(),
                        ctx.emit('created-apto')
                    }, 1000);
                }
            })
            // form.post(route('apartment.create'), {
            //     onSuccess:(e) => {
            //         form.reset(),
            //         console.log(e.props)
            //         // store.commit("condominia/setBlock", e.props.blocks)

            //     },
            //     onError:() => styleForm.value = 'block w-full rounded-md px-4 border-red-700  form-input',
            //     onFinish:() => {
            //         form.reset(),
            //         setTimeout(() => {
            //             router.reload(),
            //             ctx.emit('created-apto')
            //         }, 1000);
            //     }
            // })
        }
        return{
            styleForm,
            form,
            submitRegister
        }
    }
})
</script>
