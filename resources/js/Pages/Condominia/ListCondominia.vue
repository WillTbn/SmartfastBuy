<template>
    <Head title="Condominios"/>
    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
    <AuthenticatedLayout>
        <template #header>
            Condominios
        </template>
        <!-- <form-created/> -->
        <div class="container flex justify-end">
            <Link
                method="get"
                class="p-2 mx-2  outline outline-offset-1 outline-green-500 rounded-lg hover:bg-green-900"
                :href="route('condominia.storeCondominia')"
            >
                <font-awesome-icon color="green" :icon="['fass', 'fa-plus']"/>
               Novo Condominio
            </Link>
        </div>
        <div v-if="condominias.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Name"/>
                    <table-head type="first" label="Status"/>
                    <table-head type="action" label="Ações"/>
                </template>
                <template #tableRows>
                    <tr v-for="cond in condominias" :key="cond.id">
                        <table-data type="first">
                            {{ cond.name }}
                        </table-data>
                        <table-data type="first">
                            {{ cond.contract_status }}
                        </table-data>
                        <table-data type="action">
                            <!-- <PrimaryButton
                                class="p-2"
                                @click.prevent="startModal(cond)"
                                v-if="cond.contract_status == 'draft'"
                            >
                                <font-awesome-icon color="white" class="mr-1"  :icon="['fass', 'fa-building-user']"/>
                               Adicionar Contrato
                            </PrimaryButton> -->
                            <Link
                                method="get"
                                class="rounded-lg bg-gray-900 p-2"
                                :href="route('condominia.ViewCreateContract', cond.id)"
                                v-if="cond.contract_status == 'draft'"
                            >
                            <font-awesome-icon color="white" class="mr-1"  :icon="['fass', 'fa-building-user']"/>
                                <span class="text-white ml-2"> Adicionar Contrato</span>
                            </Link>
                            <!-- <Link
                                method="get"
                                class="p-2 rounded-lg outline outline-offset-1 outline-cyan-500 hover:bg-gray-300 "
                                :href="route('condominia.getOne', cond.id)"
                                v-if="userMaster && cond.contract_status == 'negotiate'"
                            >
                                <font-awesome-icon color="gray" class="mr-1"  :icon="['fass', 'fa-file-contract']"/>

                                <span class="text-gray-900 ml-2">editar contrato</span>

                            </Link> -->
                            <Link
                                method="get"
                                class="rounded-lg bg-lime-900 p-2"
                                :href="route('condominia.getOne', cond.id)"
                                v-if="cond.contract_status == 'start'"
                            >
                                <font-awesome-icon color="green"  :icon="['fass', 'fa-building-circle-arrow-right']"/>
                                <span class="text-white ml-2">GERENCIAR</span>
                            </Link>
                            <!-- faBuildingCircleArrowRight -->
                            <!-- <font-awesome-icon :icon="['fas', 'building-circle-arrow-right']" /> -->
                        </table-data>
                    </tr>
                </template>
            </table-body>
        </div>
        <div class="text-center max-auto max-w-7x1 sm:px-6 lg:px-8" v-else>
            <p> Não há condominios cadastrados</p>
        </div>

        <modal :show="resp" @close="closeModal">
          <create-responsable></create-responsable>
        </modal>


    </AuthenticatedLayout>
</template>
<script>
import { Head,Link} from '@inertiajs/vue3';
import { useStore } from 'vuex';
import {defineComponent, ref, onMounted} from 'vue'
import {useUserStore} from '../../storePinia/user'
import { storeToRefs } from 'pinia';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import Modal from '../../Components/Modal.vue';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import DangerButton from '../../Components/DangerButton.vue';
import InfoButton from '@/Components/Buttons/InfoButton.vue';
import CreateResponsable from '@/Layouts/users/responsable/CreateResponsable.vue';
// import FormCreated from '../../Layouts/Condominia/FormCreated.vue';
import Dialog from '@/Components/Dialog.vue';
import {useCondominiaStore} from '../../storePinia/condominia'

export default defineComponent({
    components:{
        TableBody,
        TableHead,
        TableData,
        // FormCreated,
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        DangerButton,
        Modal,
        CreateResponsable,
        InfoButton,
        Dialog
    },
    props:{
        condominias:{type:Array},
        flash:{type:Object},
    },
    setup(props){
        const storeUser= useUserStore()
        const { userMaster } = storeToRefs(storeUser)
        const storeCond = useCondominiaStore()

        const resp = ref(false)
        const store = useStore()

        const setCond = (condominia) => {
            store.commit("condominia/setCondomina", condominia)
        }
        const closeModal = () =>{
            resp.value = false
        }
        const startModal = (condominia) =>{
            setCond(condominia)
            resp.value = true
        }
        onMounted(()=>{
            storeCond.setCondomina(props.condominias)
        })

        return{
            userMaster,
            setCond,
            resp,
            startModal,
            closeModal
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

})
</script>
