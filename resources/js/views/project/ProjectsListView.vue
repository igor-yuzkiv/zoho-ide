<script setup>
import {onBeforeMount, ref} from "vue";
import {useRouter} from "vue-router";
import XButton from "@/components/base/button/XButton.vue";
import {Icon} from "@iconify/vue";
import XModal from "@/components/base/modal/XModal.vue";
import ProjectsTable from "@/views/project/components/ProjectsTable.vue";
import {useStore} from "vuex";

const router = useRouter();
const store = useStore();
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

onBeforeMount(() => {
    store.commit("mutatePageTitle", "Projects");
})

</script>

<template>
    <div class="flex items-center justify-end mb-2 p-2 border-b border-dashed">
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

    </x-modal>
</template>

<style scoped>

</style>
