<template>
    <div class="create-reponsible py-4">
        <div class="grid justify-center text-center m-3">
            <h2 class="text-2xl font-medium">
                Adicionar responsavel para o condominio e que irá assinar o contrato
            </h2>
        </div>
        <Form @submit="submitRegister" class="mx-auto max-w-7xl sm:px-2 lg:px-8 md:max-w-5xl" v-slot="{errors}">

            <div class="grid grid-cols-3 gap-4">
                <div>

                    <input-text
                        textLabel="Nome"
                        name="firstName"
                        rulesText="required"
                        v-model="formData.firstName"
                        :error="errors.firstName != null"
                    />

                    <input-error class="mt-2" :message="errors.firstName" v-if="errors.firstName"/>
                </div>
                <div>
                    <input-text
                        textLabel="Sobrenome"
                        name="lastName"
                        rulesText="required"
                        v-model="formData.lastName"
                        :error="errors.lastName != null"
                    />

                    <input-error class="mt-2" :message="errors.lastName" v-if="errors.lastName"/>
                </div>
                <div>

                    <input-text
                        textLabel="E-mail"
                        typeInput="email"
                        name="email"
                        rulesText="required|email"
                        v-model="formData.email"
                        :error="errors.email != null"
                        />

                        <input-error class="mt-2" :message="errors.email" v-if="errors.email"/>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-5 mt-5">
                    <div>
                    <input-text
                        textLabel="Senha"
                        typeInput="password"
                        name="password"
                        :rulesText="`required|confirmed:${formData.password_confirmation}`"
                        v-model="formData.password"
                        :error="errors.password != null"
                    />

                    <input-error class="mt-2" :message="errors.password" v-if="errors.password"/>
                </div>
                <div>
                    <input-text
                        textLabel="Confirme a senha*"
                        typeInput="password"
                        name="password_confirmation"
                        :rulesText="`required|confirmed:${formData.password}`"
                        v-model="formData.password_confirmation"
                        :error="errors.password_confirmation != null"
                    />

                    <input-error class="mt-2" :message="errors.password_confirmation" v-if="errors.password_confirmation"/>

                </div>
                <!-- <input-error class="mt-2" message="As senhas não coincidem." v-if="errors.passwordMatch('passwordMatch')"/> -->
                <!-- <button
                style=" margin: auto;"
                @click.prevent="sendPassword"
                class="p-2 font-extrabold text-white rounded-sm bg-sky-500 hover:bg-sky-600"
                >
                    gerar Senha
                </button> -->
        </div>
            <div class="grid grid-cols-3 gap-3 mt-5">
                <div>
                    <input-text
                        textLabel="CPF*"
                        typeInput="person"
                        name="person"
                        rulesText="required|minPerson"
                        v-model="formData.person"
                        :error="errors.person != null"
                        maskText="###.###.###-##"
                    />

                    <input-error class="mt-2" :message="errors.person" v-if="errors.person"/>
                </div>
                <div>
                    <input-text
                        textLabel="Data de Nascimento*"
                        typeInput="birthday"
                        name="birthday"
                        rulesText="required"
                        v-model="formData.birthday"
                        :error="errors.birthday != null"
                        maskText="##/##/####"
                    />

                    <input-error class="mt-2" :message="errors.birthday" v-if="errors.birthday"/>
                </div>
                <div>
                    <label class="block">
                        <span for="genre" class="light:text-gray-700">Qual genero se idenfica *</span>
                        <select v-model="formData.genre" :class="styleForm">
                            <option v-for="item in getGenre" :key="item.id" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                        <input-error class="mt-2" :message="formData.errors.genre" v-if="formData.errors.genre"/>
                    </label>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3 mt-5">
                <div>
                    <input-text
                        textLabel="Telefone*"
                        typeInput="telephone"
                        name="telephone"
                        rulesText="required|minTelephone"
                        v-model="formData.telephone"
                        :error="errors.telephone != null"
                        maskText="## ####-####"
                    />
                    <input-error class="mt-2" :message="errors.telephone" v-if="errors.telephone"/>
                </div>
                <div>
                    <input-text
                        textLabel="Celular*"
                        typeInput="phone"
                        name="phone"
                        rulesText="required|minphone"
                        v-model="formData.phone"
                        :error="errors.phone != null"
                        maskText="## #####-####"
                    />
                    <input-error class="mt-2" :message="errors.phone" v-if="errors.phone"/>

                </div>
                <div>
                    <label class="block">
                        <span for="notifications" class="light:text-gray-700">Receber notitificações ?*</span>
                        <select v-model="formData.notifications" :class="styleForm">
                            <option v-for="item in notYes" :key="item.id" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                        <input-error class="mt-2" :message="formData.errors.notifications" v-if="formData.errors.notifications"/>
                    </label>
                </div>
            </div>
            <!-- <button type="submit">Sign up</button> -->
            <PrimaryButton class="m-6"
            type="submit"
            >
            <!-- :class="{ 'opacity-25': form.processing }" :disabled="form.processing" -->
                Proxima etapa
            </PrimaryButton>
            <!-- <span v-if=""></span> -->

        </Form>
    </div>
</template>
<script setup>
const styleForm = "block w-full px-4 border-transparent rounded form-input text-black"
import {Form} from 'vee-validate'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import InputError from '@/Components/Forms/InputError.vue'
import InputText from '@/Components/Forms/VeeValidate/InputText.vue'
import useNotify from '../../composables/useNotify'
import useStrandardFields from '../../composables/useStandardFields'
import { storeToRefs } from 'pinia';
import { useContractStore } from '../../storePinia/contract';

const props = defineProps({
    condominia_id:{
        type:Number
    },
    erros:{type:Object|Array}
})
const {multError} = useNotify()
const {passwordGenerator, notYes, getGenre} = useStrandardFields()
const useContract = useContractStore()
const {formData} =  storeToRefs(useContract)

const submitRegister = (values) => {
    console.log(JSON.stringify(values, null, 2));
    formData.value.condominia_id = props.condominia_id
    console.log(formData.value)
    useContract.setStep('stepContract')
    // form.post(route('contract.create'), {
        //     onError:(e) => multError(e),
        //     onSuccess:() => form.reset()
        // })
    }


const sendPassword = () => {
    let passwordDefault = passwordGenerator()
    // useContract.setSamePassword(passwordDefault)
    formData.value.password = passwordDefault
    formData.value.password_confirmation = passwordDefault
    // console.log('amigo estou aqui', formData.value.password)
}
// const form = useForm({
//     name:formData.value.name,
//     role_id:2,
//     email:formData.value.email,
//     password:formData.value.password,
//     password_confirmation:formData.value.password_confirmation,
//     remember:false,
//     notifications: formData.value.notifications,
//     person: formData.value.person,
//     telephone: formData.value.telephone,
//     genre: formData.value.genre,
//     birthday:formData.value.birthday,
//     phone:formData.value.phone,
//     condominia_id:props.condominia_id
// })

</script>
<style>

</style>
