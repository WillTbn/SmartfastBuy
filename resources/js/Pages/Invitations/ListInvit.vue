<template>
    <Head title="Convites"/>
    <AuthenticatedLayout>
        <template #header>
            Convites
        </template>
        <form-create-invite
            :condominia="condominias"
        ></form-create-invite>
        <div v-if="invites.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Name"/>
                    <!-- <table-head type="normal" label="Preço"/>
                    <table-head type="normal" label="Quantidade"/>
                    <table-head type="first" label="Código de barra"/>
                    <table-head type="normal" label="Condominio"/>
                    <table-head type="normal" label="actions"/>
                    -->
                </template>
                <template #tableRows>
                    <tr v-for="invite in invites" :key="invite.id">
                        <table-data type="first">
                            {{ invite.name }}
                        </table-data>
                        <!-- <table-data type="first">
                            {{ invite.value }}
                        </table-data>
                        <table-data type="first">
                            {{ invite.quantity }}
                        </table-data>

                        <table-data type="first">
                            {{ invite.barcode }}
                        </table-data>

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
    </AuthenticatedLayout>
</template>
<script>
import { Head,Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import FormCreateInvite from '../../Layouts/invites/FormCreateInvite.vue';

export default{
    components:{
        TableBody,
        TableHead,
        TableData,
        Head,
        Link,
        AuthenticatedLayout,
        FormCreateInvite
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
