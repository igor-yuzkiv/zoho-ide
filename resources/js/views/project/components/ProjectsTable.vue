<script setup>
import {onMounted, ref} from "vue";
import {deleteProject, fetchProjects} from "@/api/project.js";
import XButton from "@/components/base/button/XButton.vue";
import {Icon} from "@iconify/vue";
import XTable from "@/components/base/table/XTable.vue";
import {PROJECT_EDIT_ROUTE} from "@/constans/routes.js";
import {useRouter} from "vue-router";
const router = useRouter();

const projects = ref([]);
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

async function loadProjects() {
    return await fetchProjects()
        .then(({data}) => {
            if (Array.isArray(data)) {
                projects.value = data;
                return projects;
            }
        })
        .catch(e => console.log(e))
}

async function deleteProjectHandle(project) {
    if (!project || !project?.id) {
        return;
    }

    if (confirm("Are you sure you want to delete the project?")) {
        await deleteProject(project.id)
            .then(() => loadProjects())
            .catch(e => console.error(e));
    }
}

function openEditProject(item) {
    router.push({
        name  : PROJECT_EDIT_ROUTE,
        params: {id: item.id}
    })
}

onMounted(() => {
    loadProjects();
});

defineExpose({loadProjects});
</script>

<template>
    <x-table
        :items="projects"
        :headers="tableHeaders"
        @row:click="openEditProject"
    >
        <template v-slot:actions="{row}">
            <x-button @click="deleteProjectHandle(row)">
                <Icon class="text-lg" icon="ic:outline-delete"></Icon>
            </x-button>
        </template>
    </x-table>
</template>

<style scoped>

</style>
