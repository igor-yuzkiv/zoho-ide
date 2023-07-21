<script setup>
import {fetchProjectConnections} from "@/api/project.js";
import {onMounted, ref} from "vue";

const props = defineProps({
    projectId: {
        type: String,
        default: 0,
        required: true,
    }
})

const connections = ref([]);

async function loadProjectConnections() {
    await fetchProjectConnections(props.projectId).then(({data}) => {
        if (Array.isArray(data)) {
            connections.value = data;
        }
    })
}

onMounted(() => {
    loadProjectConnections();
})

</script>

<template>
    {{projectId}}
</template>

<style scoped>

</style>
