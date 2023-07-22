<script setup>
import {onBeforeMount} from "vue";
import {useStore} from "vuex";
import ConnectionForm from "@/views/connection/parts/connection-form/ConnectionForm.vue";
const store = useStore();


onBeforeMount(() => {
    store.commit('SET_PAGE_TITLE', 'Create New Connection')
    store.commit('ui/SET_CONTEXT_MENU_ITEMS', [])
})
</script>

<template>
    <connection-form></connection-form>
</template>

<style scoped>

</style>
