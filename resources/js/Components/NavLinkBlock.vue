<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    iconName:{
        type:String
    }
});

const classes = computed(() =>
    props.active
        ? 'inline-flex block text-lg items-center pt-1 border-b-2 border-indigo-800 light:border-indigo-400 text-sm font-medium leading-5 light:text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'inline-flex block text-lg items-center pt-1 border-b-2 border-transparent text-sm font-medium leading-5 light:text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <font-awesome-icon :icon="iconName" class="mx-2 mr-5"/>
        <slot />
    </Link>
</template>
