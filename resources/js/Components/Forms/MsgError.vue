<template>
    <div class="font-medium text-red-700 msg-error">
        {{ message}}
    </div>
</template>
<script>
import {defineComponent} from 'vue'
export default defineComponent({
    props:{
        message:{type:String}
    }
})
</script>
