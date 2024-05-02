<template>
    <div class="success-finally mx-auto max-w-7xl sm:px-2 lg:px-8  md:max-w-4xl flex justify-center">
        <!-- <div class="flex justify-center">
            <div class="grid grid-cols-6">
                <font-awesome-icon class=" hover:animate-bounce fas fa-camera fa-7x" color="green" :icon="['fass', 'fa-circle-check']"/>
            </div>
            <div class="grid grid-cols-8 gap-12">

              Teste

            </div>
        </div> -->
        <ul class="max-w-md space-y-2 text-gray-500 list-inside dark:text-gray-400">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Totas as seguintes etapas foram concluidas</h2>
            <li class="flex items-center">
                <svg class="w-4 h-4 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                Usuário criado com permissão de responsavel, pelo condominio.
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                Contrato criado!
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                Email com senha enviado para o responsavel, junto com o contrato, para conhecimento.
            </li>
        </ul>

    </div>
</template>
<script setup>
defineProps({
    message:{type:String},
    description:{type:String}
})
</script>
<style>

</style>
