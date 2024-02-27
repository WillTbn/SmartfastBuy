<template>
    <Head title="Condominio"/>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <AuthenticatedLayout>
        <div class="p-4 mx-auto mt-6 space-y-6 md:container" >
            <div class="grid grid-cols-6 gap-12 text-center">
                <h1 class="text-xl font-bold"> {{ condominia.name }}</h1>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <h3 class="text-lg font-medium text-center">
                Blocos
            </h3>
            <div class="">
                <primary-button @click="createdBlock = true" v-if="createdBlock == false">
                   <span>
                       Adicionar bloco
                        <font-awesome-icon color="" :icon="['fass', 'fa-plus']"/>
                   </span>
                </primary-button>

                <primary-button @click="createdBlock = false" v-if="createdBlock == true">
                   <span>
                    volta
                    <!-- faWindowClose -->
                        <font-awesome-icon color="" :icon="['fass', 'fa-close']"/>
                   </span>
                </primary-button>

            </div>

        </div>
        <div v-if="createdBlock == true" class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <created-block/>
        </div>
        <div v-if="blocks.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Name"/>
                    <table-head type="normal" label="Total de apartamentos"/>
                    <!--
                    <table-head type="normal" label="actions"/>
                    -->
                </template>
                <template #tableRows>
                    <tr v-for="block in blocks" :key="block.id">
                        <table-data type="first">
                            {{ block.name }}
                        </table-data>
                        <table-data type="first">
                            {{ block.apartments.length }}
                        </table-data>
                        <table-data type="normal">
                            <primary-button @click="viewBlock(block)">
                            <span>
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
        <div class="text-center max-auto max-w-7x1 sm:px-6 lg:px-8" v-if="blocks.length == 0">

            <p> Não há block cadastrado nesse codoominio</p>

        </div>

        <modal :show="modalSet" @close="closeModal" >
            <index-block ></index-block>
        </modal>

        <!-- <dialog
            :open="DialogOpen"
            title="Alguma coisa"
            description="Descrição de algo"
            button="olá buttoon"
        ></dialog> -->
    </AuthenticatedLayout>
</template>
<script>
import { Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import { computed, onMounted, ref } from 'vue';
import CreatedBlock from '../../Components/Forms/CreatedBlock.vue';
import PrimaryButton from '../../Components/PrimaryButton.vue';
import { useStore } from 'vuex';
import Dialog from '../../Components/Dialog.vue';
import Modal from '../../Components/Modal.vue';
import IndexBlock from '../Block/IndexBlock.vue';

export default{
    components:{
        Head,
        AuthenticatedLayout,
        TableBody,
        TableHead,
        TableData,
        CreatedBlock,
        PrimaryButton,
        Dialog,
        Modal,
        IndexBlock
    },
    props:{
        // roles:{type:Array},
        flash:{type:Object},
        condominia:{type:Object},
        blocks:{type:Array}
    },

    setup(){
        const createdBlock = ref(false)
        const DialogOpen = ref(false)
        const store = useStore()
        const id = computed(()=> store.state.condominia.id)
        const modalSet= ref(false)
        const control = "modal-center"
        const viewBlock = (block) =>{
            modalSet.value = true
            store.commit("condominia/setBlock", block)
        }
        const closeModal = () =>{
            modalSet.value = false
        }
        onMounted(() =>{
            console.log('ESTOU AQUI !!!')
            console.log('AQUI ESTA ID ', id.value)
            // console.log(props.condominia)
        });
        return {
            viewBlock,
            closeModal,
            modalSet,
            createdBlock,
            DialogOpen
        }
    }

    // setup(){
    //     const submit = (id) => {
    //         alert(id)
    //         if(confirm("are you sure you want to delete this user?"))
    //         {
    //             $this.$inertia.delete(`users/${id}`)
    //         }
    //     }

    //     return {
    //         submit
    //     }
    // }

}
</script>
<style>
.modal-center{
    margin: 15rem auto auto auto
}
</style>
