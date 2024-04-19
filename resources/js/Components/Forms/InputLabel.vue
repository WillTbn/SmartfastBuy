<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="text-lg block font-medium light:text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
