<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ block.name }}

        </h2>
        INDEX DO BLOCO
        <div class="flex justify-end mt-6">
            <secondary-button @click="closeModel"> fechar</secondary-button>
        </div>
    </div>
</template>
<script>
import {useStore} from 'vuex'
import {computed, defineComponent} from 'vue'
import SecondaryButton from '../../Components/SecondaryButton.vue';
export default defineComponent({
    components:{SecondaryButton},
    setup(){
        const store = useStore()
        const block = computed(()=>store.state.condominia.block)
        const closeModel = () => {
            console.log('TEM QUE FECHA O MODAL')
        }

        return{
            block,
            closeModel
        }
    }
})

</script>
<!-- <script setup>
import {computed, ref} from 'vue';
import { useStore } from 'vuex';
import SecondaryButton from '../../Components/SecondaryButton.vue';


const store = useStore()
const block = computed(()=> store.state.condominia.block)
const closeModel = () =>{
    console.log('VAI FECHA MODAL')
}


</script> -->
