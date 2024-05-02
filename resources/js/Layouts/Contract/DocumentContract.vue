<template>
    <div class="document-contract">
        <div class="grid justify-center text-center m-3">
            <h2 class="text-2xl font-medium">
                Dados do contrato
            </h2>
        </div>
        <Form @submit="submitFinally" class="mx-auto max-w-7xl sm:px-2 lg:px-8  md:max-w-4xl" v-slot="{errors}">
            <div class="grid grid-cols-3 gap-4">
                <div class="">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Documento do contrato</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file"
                        ref="document"
                        name="document"
                        accept=".doc,.docx,.pdf"

                        @change="getDocument($event)"
                    >
                    <!-- <input-error class="mt-2" :message="errors.signature" v-if="errors.signature"/> -->
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                        PDF, DOCX (MAX. 1240mb).
                    </p>
                    <input-error class="mt-2" v-if="formData.errors.document" :message="formData.errors.document"/>
                </div>

                <div class="">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Data inicio de contrato(pode ser previa)</label>
                    <VueDatePicker class="dark:dp__theme_dark" locale="pt-BR" v-model="formData.initial_contract" month-picker />
                    <input-error class="mt-2" v-if="formData.errors.initial_date" :message="formData.errors.initial_date"/>
                </div>
                <div class="">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Data Final do contrato(pode ser previa)</label>
                    <VueDatePicker class="dark:dp__theme_dark" v-model="formData.final_contract" month-picker/>
                    <input-error class="mt-2" v-if="formData.errors.final_date" :message="formData.errors.final_date"/>
                </div>
            </div>
            <div class="">
                <h3 class="my-2 font-semibold text-gray-900 dark:text-white">Você vai assinar agora o contrato?</h3>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="horizontal-list-radio-license" v-model="formData.ceo" type="radio" :value="true" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assinar o documento </label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="horizontal-list-radio-id" type="radio" v-model="formData.ceo" :value="false" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-id" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Não assinar o documento</label>
                        </div>
                    </li>
                </ul>
                <input-error class="mt-2" v-if="formData.errors.ceo" :message="formData.errors.ceo"/>
            </div>
            <PrimaryButton class="m-6" @click="backToback">
               Voltar
            </PrimaryButton>
            <PrimaryButton class="m-6">
               Submit
            </PrimaryButton>
        </Form>
    </div>
</template>
<script setup>
import {Form} from 'vee-validate'
import { useContractStore } from '../../storePinia/contract';
import { storeToRefs } from 'pinia';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import InputError from '@/Components/Forms/InputError.vue'
import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3'
import useNotify from '../../composables/useNotify'

const selectFile = ref()
const getDocument = (e) =>{
    selectFile.value = e.target.files[0]
}
function formatToTwoDigits(str) {
  const num = parseInt(str);
  return (num < 10) ? `0${num}` : num.toString();
}
const format = (date) => {
    if(date){
        const formMonth = formatToTwoDigits(date.month+1)
        const year = date.year;
        return `${formMonth}-${year}`
    }
    return "";
}
const document = ref({})

const useContract = useContractStore()
const {multError}= useNotify()
const {formData} = storeToRefs(useContract)
const backToback = () => {
    useContract.setStep('initial')
    console.log('backToback -> ', formData.value)
}
const submitFinally = () =>{
    formData.value.initial_date = format(formData.value.initial_contract)
    formData.value.final_date = format(formData.value.final_contract)
    formData.value.name = useContract.setName
    ///document
    // let dataForm = new FormData()
    // dataForm.append('document', selectFile.value, selectFile.value.name)
    console.info(selectFile.value)
    formData.value.document = selectFile.value

    const form = useForm({...formData.value})
    form.post(route('contract.create'), {
        onSuccess:()=>{
            form.reset()
            useContract.setStep('finally')
        },
        onError:(e)=>{
            multError(e)
            useContract.setErros(e)
        }
    })
    console.log('formart ->', form)
}
</script>
<style>
.dp__theme_dark {
    --dp-background-color: #212121;
    --dp-text-color: #fff;
    --dp-hover-color: #484848;
    --dp-hover-text-color: #fff;
    --dp-hover-icon-color: #959595;
    --dp-primary-color: #005cb2;
    --dp-primary-disabled-color: #61a8ea;
    --dp-primary-text-color: #fff;
    --dp-secondary-color: #a9a9a9;
    --dp-border-color: #2d2d2d;
    --dp-menu-border-color: #2d2d2d;
    --dp-border-color-hover: #aaaeb7;
    --dp-disabled-color: #737373;
    --dp-disabled-color-text: #d0d0d0;
    --dp-scroll-bar-background: #212121;
    --dp-scroll-bar-color: #484848;
    --dp-success-color: #00701a;
    --dp-success-color-disabled: #428f59;
    --dp-icon-color: #959595;
    --dp-danger-color: #e53935;
    --dp-marker-color: #e53935;
    --dp-tooltip-color: #3e3e3e;
    --dp-highlight-color: rgb(0 92 178 / 20%);
    --dp-range-between-dates-background-color: var(--dp-hover-color, #484848);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #fff);
    --dp-range-between-border-color: var(--dp-hover-color, #fff);
}
.dp__theme_light {
    --dp-background-color: #fff;
    --dp-text-color: #212121;
    --dp-hover-color: #f3f3f3;
    --dp-hover-text-color: #212121;
    --dp-hover-icon-color: #959595;
    --dp-primary-color: #1976d2;
    --dp-primary-disabled-color: #6bacea;
    --dp-primary-text-color: #f8f5f5;
    --dp-secondary-color: #c0c4cc;
    --dp-border-color: #ddd;
    --dp-menu-border-color: #ddd;
    --dp-border-color-hover: #aaaeb7;
    --dp-disabled-color: #f6f6f6;
    --dp-scroll-bar-background: #f3f3f3;
    --dp-scroll-bar-color: #959595;
    --dp-success-color: #76d275;
    --dp-success-color-disabled: #a3d9b1;
    --dp-icon-color: #959595;
    --dp-danger-color: #ff6f60;
    --dp-marker-color: #ff6f60;
    --dp-tooltip-color: #fafafa;
    --dp-disabled-color-text: #8e8e8e;
    --dp-highlight-color: rgb(25 118 210 / 10%);
    --dp-range-between-dates-background-color: var(--dp-hover-color, #f3f3f3);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #212121);
    --dp-range-between-border-color: var(--dp-hover-color, #f3f3f3);
}
</style>
