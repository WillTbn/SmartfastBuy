<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-4xl font-extrabold leading-tight  light:text-gray-800"> Contrato </h2>
        </template>
        <stepper-layout/>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import StepperLayout from '../../Layouts/Contract/StepperLayout.vue';
export default defineComponent({
    props:{
        condominia:{type:Object},
        flash:{type:Object}
    },
    components:{
        Head,
        StepperLayout,
        AuthenticatedLayout
    }
})
</script>
