<template>
    <div>
        <table-body class="text-white">
            <template #headColumns>
                <table-head type="first" label="Codigo"/>
                <table-head type="normal" label="Tipo de codigo"/>
                <table-head type="normal" label="Quantidade"/>
                <table-head type="normal" label="actions"/>
            </template>
            <template #tableRows>
                <tr v-for="(barcode, index) in barcodeProduct" :key="index">
                    <table-data type="first">
                        {{ barcode.barcode }}
                    </table-data>
                    <table-data type="first">
                        {{ barcode.type_code }}
                    </table-data>
                    <table-data type="first">
                        {{ barcode.quantity }}
                    </table-data>
                    <table-data type="first">
                     butão
                    </table-data>
                </tr>
            </template>
        </table-body>
    </div>
</template>
<script>
import {defineComponent} from 'vue'
import TableHead from '../../Components/Table/TableHead.vue';
import TableData from '../../Components/Table/TableData.vue';
import TableBody from '../../Components/Table/TableBody.vue';
export default defineComponent({
    components:{
        TableBody,
        TableHead,
        TableData,
    },
    props:{
        barcodeProduct:{type:Array}
    },
    setup(){
        return{

        }
    }
})
</script>
<style>

</style>
