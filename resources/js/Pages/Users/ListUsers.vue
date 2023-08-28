<template>
    <Head title="Usuários"/>
    <AuthenticatedLayout>
        <template #header>
            Usuários
        </template>
        <form-create
            :roles="roles"
        ></form-create>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <table-body>
                <template #headColumns>
                    <table-head type="first" label="Name"/>
                    <table-head type="first" label="Email"/>
                    <table-head type="normal" label="Permissions"/>
                    <table-head type="normal" label="actions"/>
                </template>
                <template #tableRows>
                    <tr v-for="user in users" :key="user.id">
                        <table-data type="first">
                            {{ user.name }}
                        </table-data>

                        <table-data type="first">
                            {{ user.email }}
                        </table-data>

                        <table-data type="normal">
                            {{ user.role_id }}
                        </table-data>
                        <table-data type="normal">
                            <Link method="delete" :href="route('users.delete', user.id)" class="trash">delete</Link>
                            <!-- <a href="router('users.delete')">excluir</a> -->
                            {{ user.id }}
                        </table-data>
                    </tr>
                </template>
            </table-body>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head,Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import FormCreate from '../../Layouts/users/FormCreate.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';

export default{
    components:{
        TableBody,
        TableHead,
        TableData,
        Head,
        Link,
        AuthenticatedLayout,
        FormCreate
    },
    props:{
        roles:{type:Array},
        users:{type:Array}
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
