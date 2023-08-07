<script setup>
import {fetchProjects}                from "@/api/projects.js";
import {computed, onBeforeMount, ref} from "vue";
import {Select}                       from "flowbite-vue";

const formData = ref({
    project: null,
    connection: null,
});

const projects = ref([]);

function prepareSelectOptions (items, valueKey = 'id', labelKey = 'name') {
    return items.map((item) => {
        const label = (typeof labelKey === 'function')
            ? labelKey(item)
            : item[labelKey];
        return {value: item[valueKey], name: label};
    });
}

const getProjectOptions = computed(() => {
    return prepareSelectOptions(projects.value);
});

const getSelectedProject = computed(() => {
    return projects.value.find(({id}) => id === formData.value.project);
});

const getConnectionOptions = computed(() => {
    const selectedProject = getSelectedProject.value;
    if (Array.isArray(selectedProject?.connections)) {
        const getLabel = (item) =>  `${item.client_id} (${item.domain})`;
        return prepareSelectOptions(selectedProject.connections, 'id', getLabel);
    }
    return [];
});


async function loadProjects() {
    const response = await fetchProjects(['connections']).catch((e) => {
        console.log("loadProjects", e);
    });

    if (Array.isArray(response)) {
        projects.value = response;
        return response;
    }
}

onBeforeMount(async () => {
    await loadProjects();
})
</script>

<template>
    <div class="grid grid-cols-2 gap-3">
        <div class="mt-2">
            <label class="text-md font-semibold">Project</label>
            <Select :options="getProjectOptions" v-model="formData.project"></Select>
        </div>

        <div class="mt-2">
            <label class="text-md font-semibold">Connections</label>
            <Select :options="getConnectionOptions" v-model="formData.connection"></Select>
        </div>
    </div>
</template>

<style scoped>

</style>