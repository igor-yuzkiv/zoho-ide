<script setup>
import http from "@/services/http.js";
import {ref, onBeforeMount} from "vue";
import {useRouter} from "vue-router";
import XTable from "@/components/table/XTable.vue";
import XButton from "@/components/button/XButton.vue";
import {Icon} from "@iconify/vue";
import XDialog from "@/components/dialog/XDialog.vue";
import XInput from "@/components/form/XInput.vue";
import {PROJECT_EDIT_ROUTE} from "@/constans/routes.js";
import {useStore} from "vuex";

const router = useRouter();
const store = useStore();

const projects = ref([]);
const projectDialogIsOpen = ref(false);
const projectDialogForm = ref({
    name: "",
});



const tableHeaders = [
    {
        name: "Name",
        value: "name",
    },
    {
        name: "Created At",
        value: "created_at_formatted",
    },
    {
        name: "Modified At",
        value: "updated_at_formatted",
    }
];

const loadProjects = async () => {
    const response = await http.get("projects")
        .then(({data}) => data)
        .catch(e => console.log(e))

    if (Array.isArray(response)) {
        projects.value = response;
    }
}

const openProjectDialog = (value) => {
    projectDialogIsOpen.value = value;
}

const openEditProject = (proejct) => {
    router.push({
        name: PROJECT_EDIT_ROUTE,
        params: {id: proejct.id}
    })
}

const createNewProjectHandle = async () => {
    await http.post("projects", projectDialogForm.value)
        .then(() => loadProjects())
        .catch(e => console.error(e))
        .finally(() => openProjectDialog(false))
}

const deleteProjectHandle = async (project) => {
    if (!project || !project?.id) {
        return;
    }

    const isConfirmed = await store.dispatch("confirmDialog/openDialog", {
        config: {
            subject: "Are you sure you want to delete the project?",
        },
    })

    if (isConfirmed) {
        await http.delete(`projects/${project.id}`)
            .then(() => loadProjects())
            .catch(e => console.error(e));
    }

    console.log("isConfirmed", isConfirmed)
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
                <Icon class="text-lg" icon="ic:outline-delete"></Icon>
            </x-button>
        </template>
    </x-table>

    <x-dialog :value="projectDialogIsOpen" @update="openProjectDialog">
        <template #header>
            Create New Project
        </template>
        <template #default>
            <x-input v-model="projectDialogForm.name" label="Project Name"></x-input>
        </template>
        <template #actions>
            <div class="flex items-center justify-between">
                <x-button class="bg-white text-gigas-500 px-4" @click="openProjectDialog(false)"> Cancel</x-button>
                <x-button class="px-4" @click="createNewProjectHandle"> Save</x-button>
            </div>
        </template>
    </x-dialog>
</template>

<style scoped>

</style>
