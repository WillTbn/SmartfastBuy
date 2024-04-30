<template>
    <Head title="Convites"/>
    <AuthenticatedLayout>
        <template #header>
            Convites
        </template>
        <div v-if="invites.length > 0" class="mx-auto max-w-7xl sm:px-6 lg:px-8 md:max-w-5xl" >
            <table-body>
                <template #headColumns>
                    <table-head type="first" label="E-mail"/>
                    <table-head type="normal" label="criado por"/>
                    <table-head type="normal" label="criado em"/>
                    <table-head type="normal" label="Ações"/>
                    <!--
                    <table-head type="normal" label="Condominio"/>
                    <table-head type="normal" label="actions"/>
                    -->
                </template>
                <template #tableRows>
                    <tr v-for="(invite, index) in invites" :key="index">
                        <table-data type="first">
                            {{ invite.email }}
                        </table-data>
                        <table-data type="normal">
                            <div  class="flex flex-row items-center ">
                                <img class="mx-2 rounded-full w-7 h-7" :src="invite.create_avatar" :srcset="invite.create_avatar" :alt="invite.create_email">
                                {{ invite.create_email }}
                            </div>
                        </table-data>
                        <table-data type="normal">
                            {{ invite.created_at }}
                        </table-data>

                        <table-data type="normal">
                            <div class="flex flex-row items-center">

                                <resend-invite :invitationId="invite.id" :key="index"/>
                                <delete-invite :invitationId="invite.id" :name="invite.name" :key="index"/>
                            </div>
                        </table-data>
                        <!--

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
import {defineComponent} from 'vue'
import { Head,Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';

import DangerButton from '@/Components/DangerButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import useNotify from '../../composables/useNotify';

import { ref } from 'vue';
import ResendInvite from '../../Components/Invitation/ResendInvite.vue';
import DeleteInvite from '../../Components/Invitation/DeleteInvite.vue';

export default defineComponent({
    components:{
        TableBody,
        TableHead,
        TableData,
        DangerButton,
        Head,
        Link,
        AuthenticatedLayout,
        DeleteInvite,
        ResendInvite,
    },
    props:{
        // roles:{type:Array},
        invites:{type:Array},
        condominias:{type:Array}
    },
    setup(){
        const {errorNotify} = useNotify()

        const submitRegister = () => {
            form.post(route('condominia.create'), {
                onSuccess:(e) => {
                    form.reset(),
                    console.log(e.props)
                    // store.commit("condominia/setBlock", e.props.blocks)

                },
                onError:() => styleForm.value = 'block w-full rounded-md px-4 border-red-700  form-input',
                onFinish:() => {
                    form.reset(),
                    setTimeout(() => {
                        router.reload()
                    }, 1000);
                }
            })
        }


        return {
            // submit
        }
    }

})
</script>
