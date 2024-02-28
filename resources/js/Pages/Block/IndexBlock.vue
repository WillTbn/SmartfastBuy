<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Bloco {{ block.name }}

        </h2>

        <div v-if="block.apartments.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Numero"/>
                    <!-- <table-head type="normal" label="Total de apartamentos"/> -->

                    <table-head type="normal" label="Ações"/>

                </template>
                <template #tableRows>
                    <tr v-for="apt in block.apartments" :key="apt.id">
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
                        </table-data>
                        <!--
                        <table-data type="normal">
                            <Link method="get" :href="route('envite.edit', product.id)"><font-awesome-icon color="green" :icon="['fass', 'fa-edit']"/></Link>

                            {{ invite.id }}
                        </table-data> -->
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
            <secondary-button @click="closeModel"> fechar</secondary-button>
        </div>
    </div>
</template>
<script>
import {useStore, mapGetters} from 'vuex'
import {computed, defineComponent} from 'vue'
import SecondaryButton from '../../Components/SecondaryButton.vue';
import NotDataList from '../../Components/NotDataList.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import PrimaryButton from '../../Components/PrimaryButton.vue';
export default defineComponent({
    components:{
        SecondaryButton,NotDataList,
        TableHead,
        TableData,
        TableBody,
        PrimaryButton
    },
    computed:{
        // aps(){
        //     return this.$store.state.condominia.block.apartments.find(ap =>ap.condominia_id === this.block.id )
        // }
    },
    setup(){
        const store = useStore()
        const block = computed(()=>store.state.condominia.block)
        // const apartments = computed(()=>store.state.condominia.block.apartments)
        // const aps = store.getters.condominia.apartmentsByIdCondominia(block.id)
        const closeModel = () => {
            console.log('TEM QUE FECHA O MODAL')
        }

        return{
            // apartments,
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
