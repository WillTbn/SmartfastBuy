<template >
    <div class="inline-flex ml-2 items-center">
        <span v-html="checkedStatus.htmlItem"></span>
        <span v-if="descriptionName">{{checkedStatus.name}}</span>
    </div>
</template>
<script setup>
import { computed } from 'vue';

const icons = {
    'draft': {htmlItem : '<span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>', name:'draft'},
    'initial': {htmlItem : '<span class="flex w-3 h-3 me-3 bg-green-500 rounded-full"></span>', name:'initial'},
    'Pending': {htmlItem : '<span class="flex w-3 h-3 me-3 bg-yellow-300 rounded-full"></span>', name:'Pending'},
    'start': {htmlItem : '<span class="flex w-3 h-3 me-3 bg-teal-500 rounded-full"></span>', name:'Start'},
}

const props = defineProps({
    nameStatus:{type:String, required:true},
    descriptionName:{type:Boolean, default:false}
})
const checkedStatus= computed({
    get(){
        return icons[props.nameStatus]
    }
})

</script>
<style lang="">

</style>
