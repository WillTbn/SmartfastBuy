<template>
    <div class="resendInvite">
        <info-button @click="resend()" v-if="statusStopWatch" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
            reenviar
            <span class="ml-2">
                <font-awesome-icon color="" :icon="['fass', 'fa-paper-plane']"/>
            </span>
        </info-button>
        <div class="" v-else>
            <p class="light:text-slate-400">Tempo para reenvio</p>
            <p class="font-mono font-medium">
                {{ hourNow }}:{{ minuteNow }}:{{ secondNow }}
            </p>
        </div>
    </div>
</template>
<script>
import {defineComponent, ref} from 'vue'
import { router, useForm } from '@inertiajs/vue3';
import InfoButton from '../../Components/Buttons/InfoButton.vue';
import useStopwatch from '../../composables/useStopwatch';
import useNotify from '../../composables/useNotify';
export default defineComponent({
    props:{invitationId:{type:Number}},
    components:{
        InfoButton
    },
    setup(props){
        const {errorNotify, successNotify} = useNotify()

        const {getDate} = useStopwatch()
        const hourNow = ref(0)
        const minuteNow = ref(0)
        const secondNow = ref(0)
        const statusStopWatch = ref(true)
        const showTime = () => {
            let now = new Date()
            var tempLast = new Date(now.setMinutes(now.getMinutes() +1))

            let timer = setInterval(() => {
                let { dia, hour, minutes, seconds, status} = getDate(tempLast)
                hourNow.value = hour
                secondNow.value = seconds
                minuteNow.value = minutes
                statusStopWatch.value = status
                if(getDate(tempLast).status){
                    clearInterval(timer)
                }
            }, 1000)
        }
        const form = useForm({
            id:props.invitationId
        })
        const resend = () => {
            // console.log('OLHA invitationId _>', form.id)
            // successNotify('Olha o id -> '+form.id)
            // console.log(form.id)
            form.put( route('invites.resend', form.id), {
                onSuccess:(e) => {
                    console.log(e.props.flash.message)
                    successNotify(e.props.flash.message)

                },
                onError:(e) => errorNotify(e),
                onFinish:() =>  showTime()
            })


        }
        return{
            resend,
            form,
            hourNow,
            secondNow,
            minuteNow,
            statusStopWatch
        }
    }
})
</script>
<style lang="">

</style>
