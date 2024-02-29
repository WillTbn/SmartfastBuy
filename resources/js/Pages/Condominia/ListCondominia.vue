<template>
    <Head title="Condominios"/>
    <AuthenticatedLayout>
        <template #header>
            Condominios
        </template>
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
                            <Link method="get" :href="route('condominia.edit', cond.id)">
                                <font-awesome-icon color="green"  :icon="['fass', 'fa-edit']"/>
                            </Link>
                        </table-data>
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
import { useStore } from 'vuex';
import {defineComponent} from 'vue'

export default defineComponent({
    components:{
        TableBody,
        TableHead,
        TableData,
        Head,
        Link,
        AuthenticatedLayout
    },
    props:{
        // roles:{type:Array},
        // invites:{type:Array},
        condominias:{type:Array}
    },
    setup(){
        const store = useStore()
        const setCond = (id) => {
            store.commit("condominia/setId", id)
        }
        return{
            setCond
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
