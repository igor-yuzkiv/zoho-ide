<script setup>
import {useRouter} from "vue-router";
import {useStore} from "vuex";
import {onBeforeMount, ref} from "vue";
import {fetchProjects} from "@/api/project.js";
import XContextMenu from "@/components/base/context-menu/XContextMenu.vue";
import routesName from "@/constans/routesName.js";

const router = useRouter();
const store = useStore();

const projects = ref([]);
const columns = [
    {
        label: "Name",
        name : "name",
        field: "name",
    },
    {
        label: "Status",
        name : "status",
        field: "status",
    },
    {
        label: "Created At",
        name : "created_at_formatted",
        field: "created_at_formatted",
    },
    {
        label: "Modified At",
        name : "updated_at_formatted",
        field: "updated_at_formatted",
    },
    {
        label: "",
        name : "actions",
        field: "actions",
    },
];

async function loadProjects() {
    return fetchProjects()
        .then(({data}) => {
            if (Array.isArray(data)) {
                projects.value = data;
                return projects;
            }
        })
        .catch(e => console.log(e))
}

function openProjectOverview({row}) {
    router.push({name: routesName.project_overview, params: {id: row.id}});
}


onBeforeMount(() => {
    loadProjects();
    store.commit("SET_PAGE_TITLE", "Projects");
    store.commit("ui/SET_CONTEXT_MENU_ITEMS", [
        {
            label  : "New Project",
            icon   : "add",
            handler: () => {
                alert("new project")
            }
        }
    ])
})
</script>

<template>
    <q-table
        :columns="columns"
        :rows="projects"
    >
        <template v-slot:body-cell-actions="params">
            <q-td class="flex justify-end">
                <x-context-menu>
                    <q-list class="tw-min-w-[100px]">
                        <q-item clickable v-close-popup @click="openProjectOverview(params)">
                            <q-item-section>
                                Overview
                            </q-item-section>
                        </q-item>
                    </q-list>
                </x-context-menu>
            </q-td>
        </template>
    </q-table>
</template>

<style scoped>

</style>
