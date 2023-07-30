<script setup>
import {onBeforeMount} from "vue";
import {useStore} from "vuex";
import ConnectionForm from "@/views/connection/parts/connection-form/ConnectionForm.vue";
import {useRouter} from "vue-router";
import routesName from "@/constans/routesName.js";

const store = useStore();
const router = useRouter();

onBeforeMount(() => {
    store.commit('SET_PAGE_TITLE', 'Create New Connection')
    store.commit('ui/SET_CONTEXT_MENU_ITEMS', [])
})

function createdHandle(e) {
    const project_id = e?.project_id;
    if (project_id) {
        router.push({name: routesName.project_overview, params: {id: project_id}});
    }
}

</script>

<template>
    <connection-form @connection:created="createdHandle"></connection-form>
</template>

<style scoped>

</style>
