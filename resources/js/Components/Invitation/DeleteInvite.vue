<template>
    <div class="delete-invite">
        <danger-button class="ml-2" @click="sendDelete()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            deletar
            <span class="ml-2">
                <font-awesome-icon color="" :icon="['fass', 'fa-trash']"/>
            </span>
        </danger-button>
    </div>
</template>
<script>
import DangerButton from '@/Components/DangerButton.vue';
import {defineComponent, ref} from 'vue'
import { router, useForm } from '@inertiajs/vue3';
import useNotify from '../../composables/useNotify';
export default defineComponent({
    components:{
        DangerButton,
    },
    props:{invitationId:{type:Number, name:{type:String}}},
    setup(props) {
        const form = useForm({
            id:props.invitationId
        })
        const {errorNotify} = useNotify()
        const  sendDelete = () =>{
            console.log('amigo estou aqui')
            if(confirm(`Tem certeza que vai excluir o convito do ${props.name}?`)){
                form.delete( route('invites.delete', form.id), {
                    onSuccess:(e) => {
                        console.log(e.props.flash.message)
                        successNotify(e.props.flash.message)
                    },
                    onError:(e) => errorNotify(e),
                    // onFinish:() =>  showTime()
                })
            }
        }
        return{
            sendDelete,
            form
        }
    }
})
</script>
<style>

</style>
