<template>
    <img v-if="!isDark" src="../../../public/img/logo-sfb-dark.png" alt="" srcset="">
    <img v-else src="../../../public/img/logo-sfb.png" alt="" srcset="">
</template>
<script setup>
import {useDark, useToggle} from '@vueuse/core';
const isDark = useDark();
</script>
