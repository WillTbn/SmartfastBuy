<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Bloco {{ block.name }}

        </h2>

        <steps-control-apartment @action-update="$emit('back-init')"/>

        <div v-if="aps.apartments.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8 table-scrol">

            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Numero"/>
                    <!-- <table-head type="normal" label="Total de apartamentos"/> -->

                    <table-head type="normal" label="Ações"/>

                </template>
                <template #tableRows>
                    <tr v-for="apt in aps.apartments" :key="apt.id">
                        <table-data type="first">
                            {{ apt.number }}
                        </table-data>
                        <!-- <table-data type="first">
                            {{ apt.apartments.length }}
                        </table-data> -->
                        <table-data type="normal">
                            <primary-button>
                                Vincular cliente
                                <span class="ml-2">
                                    <font-awesome-icon color="" :icon="['fass', 'fa-plus']"/>
                                </span>
                            </primary-button>
                            <danger-button class="ml-2" @click="deletedApto(apt.id)">
                                deletar
                                <span class="ml-2">
                                    <font-awesome-icon color="" :icon="['fass', 'fa-trash']"/>
                                </span>
                            </danger-button>
                        </table-data>
                    </tr>
                </template>
            </table-body>
        </div>
        <div v-else>
            <not-data-list>
                Não há apartamento cadastrado nesse bloco.
            </not-data-list>
        </div>
        <div class="flex justify-end mt-6">
            <secondary-button @click="$emit('back-init')"> fechar</secondary-button>
        </div>
    </div>
</template>
<script>
import {useStore, mapGetters} from 'vuex'
import {computed, defineComponent, ref} from 'vue'
import SecondaryButton from '../../Components/Buttons/SecondaryButton.vue';
import GreenButton from '../../Components/Buttons/GreenButton.vue';
import NotDataList from '../../Components/NotDataList.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import DangerButton from '../../Components/DangerButton.vue';
import StepsControlApartment from '../../Layouts/Apartment/StepsControlApartment.vue';
import { Head, useForm, router} from '@inertiajs/vue3';
import { Inertia} from '@inertiajs/inertia'
export default defineComponent({
    components:{
        SecondaryButton,NotDataList,
        TableHead,
        TableData,
        TableBody,
        PrimaryButton,
        DangerButton,
        GreenButton,
        StepsControlApartment
    },
    computed:{
        aps(){
            return this.$store.state.condominia.block
        }
    },
    setup(){
        const store = useStore()

        const block = computed(()=>store.state.condominia.block)
        const condominia = computed(() => store.state.condominia)
        // const apartments = computed(()=>store.state.condominia.block.apartments)
        // const aps = store.getters.condominia.apartmentsByIdCondominia(block.id)
        const deletedApto = (id) =>{
            if(confirm('Tem certeza que vai excluir este apartamento?')){
                Inertia.delete(route('apartment.delete', id))
                setTimeout(() =>{
                    router.reload()
                }, 1000)
            }
            // // form.id = id
            // form.delete(route('blocks.delete', id))
        }

        return{
            deletedApto,
            condominia,
            block,
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
