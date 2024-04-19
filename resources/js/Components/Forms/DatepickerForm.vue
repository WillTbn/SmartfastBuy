<script setup>
import { onMounted, ref } from 'vue';
import InputLabel from './InputLabel.vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    error:{
        type:Boolean,
        default: false
    },
    textLabel:{type:String},
});

defineEmits(['update:modelValue']);

const input = ref(null);
defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input-label :value="textLabel"/>
    <VueDatePicker
        ref="input"
        class="dark:dp__theme_dark"
        :value="modelValue"
        month-picker
    />
        <!-- @change="handleChange" -->

</template>
