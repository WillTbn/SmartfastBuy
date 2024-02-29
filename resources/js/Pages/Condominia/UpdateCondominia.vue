<template>
    <Head title="Condominio"/>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <AuthenticatedLayout>
        <div class="bloco-list" v-if="!modalSet">

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
                                    add apartamento
                                    <span class="ml-2">
                                        <font-awesome-icon color="" :icon="['fass', 'fa-plus']"/>
                                    </span>
                                </primary-button>
                            </table-data>
                            <table-data type="normal">
                                <danger-button @click="deletedBlock( block.id)" v-if="block.apartments.length <= 0">
                                    excluir bloco
                                    <span class="ml-2">
                                        <font-awesome-icon color="" :icon="['fass', 'fa-xmark']"/>
                                    </span>
                                </danger-button>
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
            <div v-if="blocks.length == 0">
                <not-data-list>
                    Não há block cadastrado nesse comdominio
                </not-data-list>
            </div>
        </div>

        <!-- <modal  @close="closeModal" > -->
        <div class="" v-else>
            <index-block @back-init="modalSet = false" ></index-block>
        </div>
        <!-- </modal> -->

        <!-- <dialog
            :open="DialogOpen"
            title="Alguma coisa"
            description="Descrição de algo"
            button="olá buttoon"
        ></dialog> -->
    </AuthenticatedLayout>
</template>
<script>
import { Head, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import { computed, onMounted, ref } from 'vue';
import CreatedBlock from '../../Components/Forms/CreatedBlock.vue';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import DangerButton from '../../Components/DangerButton.vue';
import { useStore } from 'vuex';
import Dialog from '../../Components/Dialog.vue';
import NotDataList from '../../Components/NotDataList.vue';
import Modal from '../../Components/Modal.vue';
import IndexBlock from '../Block/IndexBlock.vue';
import { faTruckMedical } from '@fortawesome/free-solid-svg-icons';

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
        IndexBlock,
        DangerButton,
        NotDataList
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
        const condominia = computed(()=> store.state.condominia)
        const modalSet= ref(false)
        const control = "modal-center"
        const form = useForm({id:''})
        const viewBlock = (block) =>{
            modalSet.value = true
            store.commit("condominia/setBlock", block)
        }
        const closeModal = () =>{
            modalSet.value = false
        }
        const deletedBlock = (id) =>{
            console.log('dentro do deletedblock',id)
            route('blocks.delete', id)
            // form.id = id
            form.delete(route('blocks.delete', id))
        }

        onMounted(() =>{
            console.log('ESTOU AQUI !!!')
            console.log('AQUI ESTA ID ', id.value)
            // console.log(props.condominia)
        });
        return {
            condominia,
            deletedBlock,
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
