<template>
    <Head title="Criação de Contrato" />
    <!-- <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" /> -->
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-4xl font-extrabold leading-tight  light:text-gray-800"> Contrato </h2>
        </template>
        <stepper-layout :steps="step"/>
        <transition name="fade" mode="out-in" :duration="{ enter: 1500, leave: 800 }">
            <create-responsible :condominia_id="condominia.id" v-if="step == 'initial'" />
            <document-contract v-else-if="step === 'stepContract'"/>
            <success-finally v-else-if="step === 'finally'" :message="flash.success" :description="flash.message"/>
        </transition>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StepperLayout from '../../Layouts/Contract/StepperLayout.vue';
import CreateResponsible from '../../Layouts/Contract/CreateResponsible.vue'
import SuccessFinally from '../../Layouts/Contract/SuccessFinally.vue'
import DocumentContract from '../../Layouts/Contract/DocumentContract.vue'
// import Dialog from '../../Components/Dialog.vue'
import {useContractStore} from '../../storePinia/contract'
import { storeToRefs } from 'pinia';

defineProps({
    condominia:{type:Object},
    flash:{type:Object}

})
const storeContract = useContractStore()
const {step} =  storeToRefs(storeContract)

</script>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
