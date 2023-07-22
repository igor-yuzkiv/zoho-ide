<script setup>

import {useRoute, useRouter} from "vue-router";
import XCard from "@/components/base/card/XCard.vue";
import {NEW_CONNECTION_ROUTE, PROJECTS_ROUTE} from "@/constans/routes.js";
import {nextTick, onMounted, ref} from "vue";
import {useStore} from "vuex";
import {fetchProject} from "@/api/project.js";
import XIconButton from "@/components/base/button/XIconButton.vue";
const route = useRoute();
const router = useRouter();
const store = useStore();
const isLoaded = ref(false);

const {id: projectId} = route.params;
if (!projectId) {
    router.push({name: PROJECTS_ROUTE});
}

const project = ref({
    id: 0,
    name: '',
    connections: [],
});

function openCreateConnection() {
    router.push({
        name: NEW_CONNECTION_ROUTE,
        params: {id: projectId}
    })
}


onMounted(async () => {
    await fetchProject(projectId, ['connections']);
});

nextTick(() => isLoaded.value = true)
</script>

<template>
   <div v-if="isLoaded">
       <x-card name="General">
            <template #actions>
                <x-icon-button icon="ic:baseline-plus" @click="openCreateConnection"/>
            </template>
       </x-card>
   </div>
</template>

<style scoped>

</style>
