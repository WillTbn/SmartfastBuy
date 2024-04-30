<template>
    <Head title="Usuários"/>
    <AuthenticatedLayout>
        <template #header>
            Usuários
        </template>
        <form-create
            :roles="roles"
        ></form-create>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 md:max-w-5xl">
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
                            {{ user.role }}
                        </table-data>
                        <table-data type="normal">
                            <danger-buton @click.prevent="submitDelete(user.id, user.name)">
                                <font-awesome-icon color="white" :icon="['fass', 'fa-trash']"/>
                            </danger-buton>
                            <!-- <Link method="delete" :href="submitDelete(user.id)" class="trash"></Link> -->
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
import { Head,Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import FormCreate from '../../Layouts/users/FormCreate.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
import DangerButon from '@/Components/DangerButon.vue';
import useNotify from '@/composables/useNotify';


export default{
    components:{
        TableBody,
        TableHead,
        TableData,
        Head,
        Link,
        AuthenticatedLayout,
        FormCreate,
        DangerButon
    },
    props:{
        roles:{type:Array},
        users:{type:Array}
    },
    setup(){
        // import useNotify from '../../composables/useNotify';
        const {successNotify, errorNotify} = useNotify()
        const submitDelete = (id, name) => {
            const form = useForm({
                id:id
            })

            if(confirm(`Tem certeza que quer excluir o usuário ${name}?`)){
                form.delete(route('users.delete', form.id), {
                    onSuccess:(e) => {
                        successNotify(e.props.flash.message)
                    },
                    onError:(e) => errorNotify(e),
                })
            }
        }

        return {
            submitDelete
        }
    }

}
</script>
