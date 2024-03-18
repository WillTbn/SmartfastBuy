<template>
    <Head title="Condominios"/>
    <AuthenticatedLayout>
        <template #header>
            Condominios
        </template>
        <form-created/>
        <div v-if="condominias.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Name"/>
                </template>
                <template #tableRows>
                    <tr v-for="cond in condominias" :key="cond.id">
                        <table-data type="first">
                            {{ cond.name }}
                        </table-data>
                        <table-data type="normal">
                            <!-- verificando se tem responsavel -->
                            <Link method="get" :href="route('condominia.getOne', cond.id)" v-if="cond.contract_status == 'start'">
                                <font-awesome-icon color="green"  :icon="['fass', 'fa-building-circle-arrow-right']"/>
                            </Link>
                            <PrimaryButton class="p-2" v-if="userMaster && cond.contract_status == 'draft'" @click.prevent="startModal(cond)">
                                <font-awesome-icon color="white" class="mr-1"  :icon="['fass', 'fa-building-user']"/>
                                Cadastra responsável
                            </PrimaryButton>
                            <!-- verificando se tem responsavel -->



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
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import Modal from '../../Components/Modal.vue';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import DangerButton from '../../Components/DangerButton.vue';
import { useStore } from 'vuex';
import {defineComponent, ref} from 'vue'
import FormCreated from '../../Layouts/Condominia/FormCreated.vue';
import CreateResponsable from '@/Layouts/users/responsable/CreateResponsable.vue';
import {useUserStore} from '../../storePinia/user'
import { storeToRefs } from 'pinia';

export default defineComponent({
    components:{
        TableBody,
        TableHead,
        TableData,
        FormCreated,
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        DangerButton,
        Modal,
        CreateResponsable
    },
    props:['condominias'],
    setup(){
        const storeUser= useUserStore()
        const { userMaster } = storeToRefs(storeUser)
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
