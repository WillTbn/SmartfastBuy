<template>
    <Head title="Produtos"/>
    <AuthenticatedLayout>
        <div class="p-4 mx-auto mt-6 space-y-6 md:container" >
            <div class="grid grid-cols-6 gap-12 text-center">
                {{ product.name }}
            </div>
            <div class="grid grid-cols-6 gap-12 text-center">
                {{ product.image_one }}
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="block">
                    {{ product.value }}
                </div>
                <div class="block">
                    {{ product.barcode }}
                </div>
                <div class="block">
                    {{ product.type }}
                </div>
                <div class="block">
                    {{ product.quantity}}
                </div>
                <div class="block">
                    {{ product.condominia_id}}
                </div>
                <div class="block">
                    {{ product.description}}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head,Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import {defineComponent} from 'vue'

export default defineComponent({
    components:{
        Head,
        Link,
        AuthenticatedLayout,
    },
    props:{
        // roles:{type:Array},
        product:{type:Object}
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
