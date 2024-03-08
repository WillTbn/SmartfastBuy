<template>
    <div class="md:px-16 md:m-auto md:container">
        <div class="grid grid-cols-3 gap-4">
            <form class="flex flex-columns" @submit.prevent="submitImage">
                <div class="mt-3">
                    <img
                        :src="previewImage.image"
                        alt=""
                        :srcset="previewImage.image"
                        class="rounded"
                        width="100" height="100"
                    >
                    <input type="file" class="d-none"
                        id="image"
                        accept="image/*"
                        ref="avatar"
                        name="avatar"
                        @change="getImage($event)"
                        @input="form.image_one = $event.target.files[0]"
                    >
                    <div v-if="formNormal.avatar" class="mt-2">
                        {{formNormal.avatar.name}}
                        <button class="btn badge-light" @click="formNormal.avatar = ''" type="button">
                            <i class="fa fa-trash text-danger"></i>
                        </button>
                    </div>
                    <div v-if="!setImage">
                        <primary-button type="submit" class="mt-2">Upload</primary-button>
                    </div>
                    <p class="font-weight-bold">Foto de principal</p>
                </div>
            </form>
        </div >
    </div>
</template>
<script>
import {ref, defineComponent} from 'vue';
import {useForm, router} from '@inertiajs/vue3';
import PrimaryButton from '../../Components/Buttons/PrimaryButton.vue';
import useNotify from '../../composables/useNotify'
export default defineComponent({
    components:{
        PrimaryButton
    },
    props:{
        imageURL:{type:String},
        product:{type:Number}
    },
    setup(props){
        const {errorNotify, multError, successNotify} = useNotify()
        const inputName = ref(false)
        const state = ref(true)
        const setImage  = ref(true)
        const avatar = ref('')
        const selectFile = ref("")
        const previewImage = ref({
            image: selectFile.value.image ? selectFile.value.image  : props.imageURL
        })

        const formNormal = ref({
            name:"",
            image:""
        })
        const form = useForm({
            image_one:null
        })
        const openFile = () => {
            avatar.value = ''
            avatar.value.click()
        }
        const getImage= (e) =>{
            let image = e.target.files[0]
            selectFile.value = image;
            console.log(selectFile.value)
            formNormal.value.name = selectFile.value.name
            let reader = new FileReader()
            reader.readAsDataURL(image);
            reader.onload = (e)=>{
                selectFile.value.image = e.target.result
                console.log('vamos colocar nova imagem!!!!')
                previewImage.value.image = e.target.result
                setImage.value = false
            };

        }
        const submitImage = () => {
            console.log(form)
            form.post(route('products.imageOne', props.product), {
                onSuccess:(e) => successNotify(e),
                onError:(e) => multError(e)
            })
        }
        return{
            previewImage,
            openFile,
            getImage,
            inputName,
            submitImage,
            state,
            setImage,
            formNormal,
            selectFile,
            form
        }
    }
})
</script>
<style scoped>
.mouse-name{
    cursor:pointer;
}
.rounded:hover{
    opacity: 0.2;
}
.edit-avatar{
    cursor: pointer;
    margin-left: -57px;
    margin-right: 47px;
    opacity: 0;
}
.edit-avatar:hover{
    opacity: 1;
}
.custom-file{
    width: 70%;
    height: 2rem;
}
.custom-file-label{
    border: 1px solid #4855BB !important;
    border-radius: 0.5rem !important;
}
</style>
