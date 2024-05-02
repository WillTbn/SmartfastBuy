<script setup>
import { useField, Field } from 'vee-validate';
import { ref } from 'vue';
import InputLabel from '../InputLabel.vue';
import {vMaska} from 'maska'

const props = defineProps({

    error:{
        type:Boolean,
        default: false
    },
    typeInput:{
        type:String,
        default:"document"
    },
    name: {type:String},
    rulesText:{type:String},
    textLabel:{type:String},
    maskText:{type:String},
    maskEaget:{type:Boolean, default:true}
});

defineEmits(['update:modelValue']);

const input = ref(null);

// onMounted(() => {
//     if (input.value.hasAttribute('autofocus')) {
//         input.value.focus();
//     }
// });

defineExpose({ focus: () => input.value.focus() });
const { value } = useField(() => props.name, undefined);
const options = ref({
    mask:props.maskText,
    eager:props.maskEaget
})
</script>

<template>
    <input-label :value="textLabel" classOrDefault="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input"/>
    <Field
        :name="name"
        :type="typeInput"
        :rules="rulesText"
        ref="input"
        aria-describedby="file_input_help" id="file_input" type="file"
        name="document"
        accept=".doc,.docx,.pdf"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        :class="{'border-rose-500' :  error}"
    />
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
        PDF, DOCX (MAX. 1240mb).
    </p>
        <!-- @change="handleChange" -->

</template>

