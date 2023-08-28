<template>
    <div class="">
        <div class="flex flex-wrap justify-center py-12">
            <h1 class="w-full px-12 "> Dados gerais</h1>
            <CardEssentialData
                v-for="value in $page.props.itens" :key="value.name"
                :name="value.name"
                :count="value.count"
                :icons="value.icons"
            />
        </div>
    </div>
</template>
<script setup>
import CardEssentialData from '@/Components/CardEssentialData.vue'
</script>