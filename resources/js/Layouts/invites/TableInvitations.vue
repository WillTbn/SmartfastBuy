<template>
    <div>
        <div v-if="invites.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Nome"/>
                    <table-head type="normal" label="criado por"/>
                    <table-head type="normal" label="criado em"/>
                    <table-head type="normal" label="Ações"/>
                    <!--
                    <table-head type="normal" label="Condominio"/>
                    <table-head type="normal" label="actions"/>
                    -->
                </template>
                <template #tableRows>
                    <tr v-for="invite in invites" :key="invite.id">
                        <table-data type="first">
                            {{ invite.name }}
                        </table-data>
                        <table-data type="normal">
                            <div  class="flex flex-row items-center ">
                                <img class="mx-2 rounded-full w-7 h-7" :src="invite.create_avatar" :srcset="invite.create_avatar" :alt="invite.create_email">
                                {{ invite.create_email }}
                            </div>
                        </table-data>
                        <table-data type="normal">
                            {{ invite.created_at }}
                        </table-data>

                        <table-data type="normal">
                            <info-button>
                                reenviar
                                <span class="ml-2">
                                    <font-awesome-icon color="" :icon="['fass', 'fa-paper-plane']"/>
                                </span>
                            </info-button>
                            <danger-button class="ml-2">
                                deletar
                                <span class="ml-2">
                                    <font-awesome-icon color="" :icon="['fass', 'fa-trash']"/>
                                </span>
                            </danger-button>
                        </table-data>
                        <!--

                        <table-data type="normal">
                            {{ invite.condominia.name }}
                        </table-data>
                        <table-data type="normal">
                            <Link method="get" :href="route('envite.edit', product.id)"><font-awesome-icon color="green" :icon="['fass', 'fa-edit']"/></Link>

                            {{ invite.id }}
                        </table-data> -->
                    </tr>
                </template>
            </table-body>
        </div>
        <div class="text-center max-auto max-w-7x1 sm:px-6 lg:px-8" v-else>

            <p> Não há convites em aberto</p>

        </div>
    </div>
</template>
<script>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import InfoButton from '@/Components/Buttons/InfoButton.vue';
import DangerButton from '@/Components/DangerButton.vue';


export default{
    components:{
        TableBody,
        TableHead,
        TableData,
        DangerButton,
        InfoButton,
    },
    props:{
        // roles:{type:Array},
        invites:{type:Array},
        condominias:{type:Array}
    },
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
