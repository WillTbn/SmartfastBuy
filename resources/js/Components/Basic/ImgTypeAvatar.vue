<template>
    <span>
        <img
            :src="linkImage"
            style="height: 2rem; width: 2rem; border-radius: 50%; background-color: #999399a6; display: inline;"
            :srcset="linkImage"
        />
    </span>
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name:"ImgTypeAvatar",
    props:{
        linkImage:{type:String},
        storage:{type:Boolean, default:true},
    },
    setup(props) {

        return{}
    }

})
</script>
<style lang="">

</style>
