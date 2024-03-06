<template>
    <Head title="Produtos"/>
    <AuthenticatedLayout>
        <template #header>
            Produtos
        </template>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8" v-if="products.length > 0">
            <table-body class="text-white">
                <template #headColumns>
                    <table-head type="first" label="Name"/>
                    <table-head type="normal" label="Preço"/>
                    <table-head type="normal" label="Quantidade"/>
                    <table-head type="first" label="sku"/>
                    <table-head type="normal" label="Condominio"/>
                    <table-head type="normal" label="actions"/>
                </template>
                <template #tableRows>
                    <tr v-for="(product, index) in products" :key="index">
                        <table-data type="first">
                            {{ product.name }}
                        </table-data>
                        <table-data type="first">
                            {{ product.value }}
                        </table-data>
                        <table-data type="first">
                            {{product.total_quantity}}
                        </table-data>

                        <table-data type="first">
                            {{ product.sku }}
                        </table-data>

                        <table-data type="first">
                            {{ product.condominia_name }}
                        </table-data>
                        <table-data type="first">
                            <Link
                            method="get"
                            :href="route('products.edit', product.id)"
                        >
                            <font-awesome-icon color="light:green" :icon="['fass', 'fa-edit']"/>
                        </Link>

                            {{ product.id }}
                        </table-data>
                    </tr>
                </template>
            </table-body>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head,Link} from '@inertiajs/vue3';
import {defineComponent} from 'vue';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';

export default defineComponent({
    components:{
        TableBody,
        TableHead,
        TableData,
        Head,
        Link,
        AuthenticatedLayout,
    },
    props:{
        // roles:{type:Array},
        products:{type:Array}
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

})
</script>
