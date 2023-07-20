<script setup>
import {ref, onBeforeMount} from "vue";
import {useRouter} from "vue-router";
import XTable from "@/components/base/table/XTable.vue";
import XButton from "@/components/base/button/XButton.vue";
import {Icon} from "@iconify/vue";
import XModal from "@/components/base/modal/XModal.vue";
import XInput from "@/components/base/input/XInput.vue";
import {PROJECT_EDIT_ROUTE} from "@/constans/routes.js";
import {useStore} from "vuex";
import {fetchProjects, createProject, deleteProject} from "@/api/project.js";

const router = useRouter();
const store = useStore();

const projects = ref([]);
const projectDialogIsOpen = ref(false);
const projectDialogForm = ref({
    name: "",
});

const tableHeaders = [
    {
        name : "Name",
        value: "name",
    },
    {
        name : "Created At",
        value: "created_at_formatted",
    },
    {
        name : "Modified At",
        value: "updated_at_formatted",
    }
];

const loadProjects = async () => {
    return await fetchProjects()
        .then(({data}) => {
            if (Array.isArray(data)) {
                projects.value = data;
                return projects;
            }
        })
        .catch(e => console.log(e))
}

const openProjectDialog = (value) => {
    projectDialogIsOpen.value = value;
}

const openEditProject = (item) => {
    router.push({
        name  : PROJECT_EDIT_ROUTE,
        params: {id: item.id}
    })
}

const createNewProjectHandle = async () => {
    await createProject(projectDialogForm.value)
        .then(() => loadProjects())
        .catch(e => console.error(e))
        .finally(() => openProjectDialog(false))
}

const deleteProjectHandle = async (project) => {
    if (!project || !project?.id) {
        return;
    }

    if (confirm("Are you sure you want to delete the project?")) {
        await deleteProject(project.id)
            .then(() => loadProjects())
            .catch(e => console.error(e));
    }
}

onBeforeMount(loadProjects)
</script>

<template>
    <div class="flex items-center justify-between mb-2 p-2 border-b border-dashed">
        <h1 class="text-black text-xs font-semibold">Projects </h1>
        <x-button
            type="button"
            @click="openProjectDialog(true)"
            title="Create Project"
        >
            <Icon class="text-lg" icon="ic:round-plus"></Icon>
        </x-button>
    </div>

    <x-table
        :items="projects"
        :headers="tableHeaders"
        @row:click="openEditProject"
    >
        <template v-slot:actions="{row}">
            <x-button class="text-gigas-500 bg-white" @click="deleteProjectHandle(row)">
                <Icon class="text-lg text-gigas-500" icon="ic:outline-delete"></Icon>
            </x-button>
        </template>
    </x-table>

    <x-modal :value="projectDialogIsOpen" @update="openProjectDialog">
        <template #header>
            Create New Project
        </template>
        <template #default>
            <x-input v-model="projectDialogForm.name" label="Project Name"></x-input>
        </template>
        <template #actions>
            <div class="flex items-center justify-between">
                <x-button
                    class="bg-white !text-gigas-500 px-4"
                    @click="openProjectDialog(false)"
                >
                    Cancel
                </x-button>
                <x-button
                    class="px-4"
                    @click="createNewProjectHandle"
                >
                    Save
                </x-button>
            </div>
        </template>
    </x-modal>
</template>

<style scoped>

</style>
