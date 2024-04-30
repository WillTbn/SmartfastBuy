<template>
    <Head title="Produtos"/>
    <AuthenticatedLayout>
        <div class="md:px-16 md:m-auto md:container md:max-w-5xl">
            <avatar-upload :imageURL="product.image_one" :product="product.id"/>
            <form @submit.prevent="submitRegister" class="p-4 mt-6 space-y-6" >
                <div class="grid grid-cols-3 gap-4">
                    <!-- <label class="block">
                        <span for="name" class="light:text-gray-700">Nome do produto*</span><br/>
                        <input id="name" type="text" v-model="product.name"
                        class="rounded form-input text-gray-950"
                        >
                        <div v-if="form.errors.name">{{ form.errors.name }}</div>
                    </label> -->
                    <div class="flex flex-col">
                        <label for="nome-product"> Nome do produto*</label>
                        <input type="text" id="nome-product" v-model="product.name" class="rounded text-gray-950 form-input" />
                        <div v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>

                    <label class="block">
                        <span for="value" class="light:text-gray-700">Preço*</span><br/>
                        <input id="value" type="text" v-model="product.value"
                        class="rounded form-input text-gray-950"
                        >
                        <div v-if="form.errors.value">{{ form.errors.value }}</div>
                    </label>
                    <div class="flex flex-col">
                        <label for="description"> Descrição</label>
                        <input type="textarea" id="description" v-model="product.description" class=" text-gray-950 form-textarea" />
                    </div>
                    <label class="block">
                        <span for="description" class="light:text-gray-700">Descrição*</span><br/>
                        <input id="description" type="textarea" v-model="product.description"
                        class=" text-gray-950 form-textarea"
                        >
                        <div v-if="form.errors.description">{{ form.errors.description }}</div>
                    </label>

                </div>
                <div class="flex flex-row justify-end">
                    <PrimaryButton class="my-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Atualizar
                    </PrimaryButton>
                </div>
            </form>
            <barcodes-product :barcodeProduct="product_one"/>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head,Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import {defineComponent} from 'vue'
import {useForm, router} from '@inertiajs/vue3'
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import BarcodesProduct from './BarcodesProduct.vue'
import AvatarUpload from '../../Layouts/Products/AvatarUpload.vue'

export default defineComponent({
    components:{
        Head,
        Link,
        AuthenticatedLayout,
        PrimaryButton,
        BarcodesProduct,
        AvatarUpload
    },
    props:{
        // roles:{type:Array},
        product:{type:Object},
        product_one:{type:Object},
    },
    setup () {

        const form = useForm({
            name:"",

        })

        return{
            form
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
