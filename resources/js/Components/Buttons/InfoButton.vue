<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-dark uppercase transition duration-150 ease-in-out border rounded-md shadow-sm bg-cyan-300 bg-cyan-400 hover:text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25"
    >
        <slot />
    </button>
</template>
