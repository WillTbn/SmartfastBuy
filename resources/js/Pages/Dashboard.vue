<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>
        <EssentialDataLayout></EssentialDataLayout>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EssentialDataLayout from '../Layouts/EssentialDataLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
