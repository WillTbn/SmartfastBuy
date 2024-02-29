<template>
    <div class="stesp-control-apartment">
        <div v-if="controlStepApartment == 'initial'">
            <div class="flex justify-center">
                <green-button @click.prevent="statusSteps('createOne')">
                    add 1 apartamento
                </green-button>
                <primary-button @click.prevent="statusSteps('createMult')">
                    add + de 1 apartamento
                </primary-button>
            </div>
        </div>
        <div  v-if="controlStepApartment == 'createOne'" class="flex justify-around p-4 m-4 rounded-md bg-slate-100">
            <created-one @created-apto="$emit('action-update')"/>
            <info-button @click.prevent="statusSteps('initial')" class="m-8">

                <font-awesome-icon  color="" :icon="['fas-solid', 'fa-arrow-left']"/>
               <span class="ml-5">voltar</span>
            </info-button>
        </div>
        <div class="flex justify-around p-4 m-4 rounded-md bg-slate-100" v-if="controlStepApartment == 'createMult'">
            <created-mult @created-apto="$emit('action-update')"/>
            <info-button @click.prevent="statusSteps('initial')" class="m-8" style="max-height: 2rem;">

                <font-awesome-icon  color="" :icon="['fas-solid', 'fa-arrow-left']"/>
                <span class="ml-5">voltar</span>
            </info-button>
        </div>
    </div>
</template>
<script>
import {computed, defineComponent, ref} from 'vue'
import GreenButton from '../../Components/Buttons/GreenButton.vue'
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue'
import InfoButton from '../../Components/Buttons/InfoButton.vue'
import CreatedOne from './CreatedOne.vue'
import CreatedMult from './CreatedMult.vue'


export default defineComponent({
    components:{GreenButton, PrimaryButton,InfoButton, CreatedOne, CreatedMult},
    setup(){
        const controlStepApartment = ref('initial')
        const statusSteps = (status) => {
            controlStepApartment.value = status
        }
        return{
            controlStepApartment,
            statusSteps
        }
    }
})
</script>
