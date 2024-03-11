<template>
    <div class="flex flex-col items-center min-h-screen pt-6 light:bg-gray-100 sm:justify-center sm:pt-0"
        :class="{'bg-black' : isDark}"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 text-gray-500 fill-current w-50" />
            </Link>
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
    <footer class="absolute bottom-10 left-10">
        <select-theme/>
    </footer>
</template>
<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import SelectTheme from '../Components/Forms/SelectTheme.vue';
import {useDark} from '@vueuse/core';
const isDark = useDark();
</script>
