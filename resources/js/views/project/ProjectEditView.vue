<script setup>
import ProjectForm from "@/views/project/components/ProjectForm.vue";
import {useRoute, useRouter} from "vue-router";
import XCard from "@/components/base/card/XCard.vue";
import {PROJECTS_ROUTE} from "@/constans/routes.js";
import {nextTick, ref} from "vue";
const route = useRoute();
const router = useRouter();
const isLoaded = ref(false);

const {id: projectId} = route.params;
if (!projectId) {
    router.push({name: PROJECTS_ROUTE});
}

nextTick(() => isLoaded.value = true)
</script>

<template>
   <div v-if="isLoaded">
       <x-card name="General">
           <project-form
               :is-edit="true"
               :project-id="projectId"
               @cancel="router.go(-1)"
           />
       </x-card>
   </div>
</template>

<style scoped>

</style>
