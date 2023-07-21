<script setup>
import {ref} from "vue";
import {useRouter} from "vue-router";
import XButton from "@/components/base/button/XButton.vue";
import {Icon} from "@iconify/vue";
import XModal from "@/components/base/modal/XModal.vue";
import ProjectForm from "@/views/project/components/ProjectForm.vue";
import ProjectsTable from "@/views/project/components/ProjectsTable.vue";

const router = useRouter();
const projectsTable = ref(null);
const projectFormDialog = ref({
    isOpen: false,
    isEdit: false,
    id: null,
});

function openProjectDialog(value) {
    projectFormDialog.value = value;
}

async function projectCreated() {
    await projectsTable.value.loadProjects();
    openProjectDialog({isOpen: false, isEdit: false, id: null});
}

</script>

<template>
    <div class="flex items-center justify-between mb-2 p-2 border-b border-dashed">
        <h1 class="text-black text-xs font-semibold">Projects</h1>
        <x-button
            type="button"
            @click="openProjectDialog({isOpen: true, isEdit: false, id: null})"
            title="Create Project"
        >
            <Icon class="text-lg" icon="ic:round-plus"></Icon>
        </x-button>
    </div>

    <projects-table ref="projectsTable"></projects-table>

    <x-modal
        :value="projectFormDialog.isOpen"
        @update="openProjectDialog"
        title="Create New Project"
    >
        <project-form
            @cancel="openProjectDialog({isOpen: false, isEdit: false, id: null})"
            @submit="projectCreated"
        />
    </x-modal>
</template>

<style scoped>

</style>
