<template>
    <div class="max-w-md py-2 mx-6 my-2 overflow-hidden bg-white shadow-sm sm:rounded-lg min-w-1/4 " >
        <div class="p-6 text-gray-900">Total de {{ name }} cadastrados {{count}}</div>
            <font-awesome-icon :icon="icons" />
    </div>
</template>
<script>
export default{
    props: {
        name:{type: String},
        count:{type:Number},
        icons:{type:String}
    }

}
</script>