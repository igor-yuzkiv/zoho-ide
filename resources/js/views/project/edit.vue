<script setup>
import ProjectForm from "@/views/project/components/ProjectForm.vue";
import {useRoute, useRouter} from "vue-router";
import XCard from "@/components/base/card/XCard.vue";
import {PROJECTS_ROUTE} from "@/constans/routes.js";
import {nextTick, ref} from "vue";
import ProjectConnectionsTable from "@/views/project/components/connection/ProjectConnectionsTable.vue";
import {Icon} from "@iconify/vue";
import XButton from "@/components/base/button/XButton.vue";
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


       <x-card class="mt-2" name="Connections">
           <template #actions>
               <x-button>
                   <Icon class="text-lg" icon="ic:baseline-plus"></Icon>
               </x-button>
           </template>
            <project-connections-table :project-id="projectId"></project-connections-table>
       </x-card>
   </div>
</template>

<style scoped>

</style>
