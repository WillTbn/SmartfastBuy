<template>
    <div class="contract-form-layout">
        <input-label for="road" value="Rua"/>
        <text-input
            id="road"
            type="text"
            class="block w-full mt-1"
            v-model="form.road"
            required
            autocomplete="road"
            :error="(form.errors.road != '' && form.errors.road != null)"
        />
        <input-error
            v-if="form.errors.road"
            :message="form.errors.road"
        />
    </div>
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name:"ContractFormLayout",
    setup(){

    }
})
</script>
<style>

</style>
