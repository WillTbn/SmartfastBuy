<script setup>
defineProps({
    message: {
        type: String,
    },

});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-600">
            <font-awesome-icon icon="fa-solid fa-triangle-exclamation" />
            {{ message }}
        </p>
    </div>
</template>
