<template>
    <Head title="Criação de Contrato" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-4xl font-extrabold leading-tight  light:text-gray-800"> Contrato </h2>
        </template>
        <stepper-layout :steps="step"/>
        <transition name="fade" mode="out-in" :duration="{ enter: 1500, leave: 800 }">
            <create-responsible :condominia_id="condominia.id" v-if="step == 'initial'" />
            <document-contract v-else-if="step === 'stepContract'"/>
        </transition>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StepperLayout from '../../Layouts/Contract/StepperLayout.vue';
import CreateResponsible from '../../Layouts/Contract/CreateResponsible.vue'
import DocumentContract from '../../Layouts/Contract/DocumentContract.vue'
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
