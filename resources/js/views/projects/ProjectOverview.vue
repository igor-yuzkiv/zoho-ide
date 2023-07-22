<script setup>
import {onMounted, ref} from "vue";
import routesName from "@/constans/routesName.js";
import {useRoute, useRouter} from "vue-router";
import {fetchProject} from "@/api/project.js";
import {useStore} from "vuex";
import XContextMenu from "@/components/base/context-menu/XContextMenu.vue";
import ConnectionAuthorizeDialog from "@/views/connection/parts/authoirize-dialog/ConnectionAuthorizeDialog.vue";

const route = useRoute();
const router = useRouter();
const store = useStore();

const authorizeConnectionDialog = ref(null);

const project = ref({});

const connectionsTableColumns = [
    {
        label : "client_id",
        name: "client_id",
        field: "client_id",
    },
    {
        label : "data_center",
        name: "data_center",
        field: "data_center",
    },
    {
        label : "domain",
        name: "domain",
        field: "domain",
    },
    {
        label : "expire",
        name: "expire",
        field: "expire",
    },
    {
        label : "",
        name: "actions",
        field: "actions",
    },
];

async function loadProject() {
    const {id} = route.params;

    if (!id) {
        return;
    }

    const response = await fetchProject(id, ['connections'])
        .then(({data}) => data)
        .catch(error => {
            console.log(error);
        });

    if (response) {
        project.value = response;
    }
    return response;
}

function openAuthConnectionDialog({row}) {
    authorizeConnectionDialog.value.open(row.id)
}

onMounted(async () => {
    const project = await loadProject();
    if (!project){
        await router.push({name: routesName.projects});
    }
    store.commit("SET_PAGE_TITLE", `${project.name} overview`)
});
</script>

<template>
    <q-card>
        <q-card-section>
            <div>
                Project Name: {{project.name}}
            </div>
        </q-card-section>
    </q-card>

    <q-card class="tw-mt-2">
        <q-card-section>
            <div class="tw-font-semibold tw-text-xl tw-my-2">Connections</div>

            <q-table
                :columns="connectionsTableColumns"
                :rows="project?.connections ?? []"
            >
                <template v-slot:body-cell-actions="params">
                    <q-td class="flex justify-end">
                        <x-context-menu>
                            <q-list class="tw-min-w-[100px]">
                                <q-item clickable v-close-popup @click="openAuthConnectionDialog(params)">
                                    <q-item-section>
                                        Authorize
                                    </q-item-section>
                                </q-item>
                            </q-list>
                        </x-context-menu>
                    </q-td>
                </template>
            </q-table>
        </q-card-section>
    </q-card>

    <connection-authorize-dialog ref="authorizeConnectionDialog"></connection-authorize-dialog>
</template>

<style scoped>

</style>
