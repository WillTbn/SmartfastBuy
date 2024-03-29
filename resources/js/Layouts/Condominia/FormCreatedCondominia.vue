<template>
    <div class="form-created">
        <form @submit.prevent="submitRegister" >
            <div class="container flex justify-center max-auto">
                <div class="columns-2xs">
                    <input-label for="name" value="Nome"/>
                    <text-input
                        id="name"
                        type="text"
                        class="block w-full mt-1 x"
                        v-model="form.name"
                        required
                        autocomplete="name"
                        :error="(form.errors.name != '' && form.errors.name != null)"
                    ></text-input>
                    <input-error
                        v-if="form.errors.name"
                        :message="form.errors.name"
                    />
                </div>
            </div>
            <div class="container max-auto">
                <div class="flex justify-center">
                    <div class="m-4">
                        <input-label for="road" value="Rua"/>
                        <text-input
                            id="road"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.road"
                            required
                            autocomplete="road"
                            :error="(form.errors.road != '' && form.errors.road != null)"
                        />
                        <input-error
                            v-if="form.errors.road"
                            :message="form.errors.road"
                        />
                    </div>
                    <div class="m-4">
                        <input-label for="number" value="Número"/>
                        <text-input
                            id="number"
                            type="number"
                            class="block w-full mt-1"
                            v-model="form.number"
                            required
                            :error="(form.errors.number != '' && form.errors.number != null)"
                        />
                        <input-error
                            v-if="form.errors.number"
                            :message="form.errors.number"
                        />
                    </div>
                    <div class="m-4">
                        <input-label for="zip_code" value="CEP"/>
                        <text-input
                            id="zip_code"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.zip_code"
                            required
                            :error="(form.errors.zip_code != '' && form.errors.zip_code != null)"
                        />
                        <input-error
                            v-if="form.errors.zip_code"
                            :message="form.errors.zip_code"
                        />
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="m-4">
                        <input-label for="city" value="Cidade"/>
                        <text-input
                            id="city"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.city"
                            required
                            :error="(form.errors.city != '' && form.errors.city != null)"
                        />
                        <input-error
                            v-if="form.errors.city"
                            :message="form.errors.city"
                        />

                    </div>
                    <div class="m-4">
                        <input-label for="state" value="Qual estado ?"/>
                        <!-- <span for="genre" class="light:text-gray-700">Qual genero se idenfica ?</span> -->
                        <select v-model="form.state" :class="styleForm">
                            <option v-for="item in states" :key="item.id" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                        <input-error
                            v-if="form.errors.state"
                            :message="form.errors.state"
                        />
                    </div>
                    <div class="m-4">
                        <input-label for="district" value="Bairro"/>
                        <text-input
                            id="district"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.district"
                        />
                        <input-error
                            v-if="form.errors.district"
                            :message="form.errors.district"
                        />
                    </div>
                </div>
            </div>
            <div class="flex justify-end container">
                <PrimaryButton class="my-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Cadastra
                </PrimaryButton>

            </div>

        </form>

    </div>
</template>
<script>
import {computed, defineComponent, ref} from 'vue'
import {useForm, router} from '@inertiajs/vue3'
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue'
import InfoButton from '../../Components/Buttons/InfoButton.vue'
import GreenButton from '../../Components/Buttons/GreenButton.vue'
import { useStore } from 'vuex'
import TextInput from '../../Components/TextInput.vue'
import InputLabel from '../../Components/InputLabel.vue'
import InputError from '../../Components/InputError.vue'
import {useCondominiaStore} from '../../storePinia/condominia'
import { storeToRefs } from 'pinia'
import AddAddress from './AddAddress.vue'
import InitialCreated from './InitialCreated.vue'

export default defineComponent({
    name:"FormCreatedCondominia",
    components:{
        AddAddress,
        InitialCreated,
        PrimaryButton,
        InfoButton,
        GreenButton,
        InputError,
        InputLabel,
        TextInput,
    },
    setup(){
        const store = useStore()
        const condominia = computed(()=> store.state.condominia)
        const useCondStore = useCondominiaStore()
        const {dataCreated} = storeToRefs(useCondStore)
        const styleForm = ref("block w-full px-4 rounded-md border-transparent  form-input")
        const states = [
            {id:0, name:"Selecioner o estado"},
            {id:1, name:"Rio de Janeiro"},
            {id:2, name:"São Paulo"},
            {id:3, name:"Bahia"},
            {id:4, name:"Rio Grande do Sul"}
        ]
        const form = useForm({
            name:"",
            road:"",
            state:"",
            number:"",
            state: {id:0, name:"Selecioner o estado"},
            zip_code:"",
            city:"",
            district:""
        })

        // const emit = defineEmits(['created-apto'])
        const submitRegister = () => {
            // console.log(form)
            form.post(route('condominia.create'), {
                onSuccess:(e) => {
                    form.reset(),
                    console.log(e.props)
                    // store.commit("condominia/setBlock", e.props.blocks)

                },
                onError:() => styleForm.value = 'block w-full rounded-md px-4 border-red-700  form-input',
                onFinish:() => {

                }
            })
        }
        return{
            states,
            styleForm,
            condominia,
            form,
            submitRegister,
            dataCreated
        }
    }
})
</script>
