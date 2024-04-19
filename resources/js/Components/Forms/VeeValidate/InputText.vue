<script setup>
import { useField, Field } from 'vee-validate';
import { ref } from 'vue';
import InputLabel from '../InputLabel.vue';
import {vMaska} from 'maska'

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    error:{
        type:Boolean,
        default: false
    },
    typeInput:{
        type:String,
        default:"text"
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
    <input-label :value="textLabel"/>
    <Field
        :name="name"
        :type="typeInput"
        :rules="rulesText"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        class="block w-full px-4 border-transparent rounded form-input text-black"
        :class="{'border-rose-500' :  error}"
        :value="modelValue"
        v-maska:[options]
    />
        <!-- @change="handleChange" -->

</template>

