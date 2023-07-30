<script setup>
import {inject, onMounted, ref} from "vue";
import routesName from "@/constans/routesName.js";
import {useRoute, useRouter} from "vue-router";
import {fetchProject} from "@/api/project.js";
import {useStore} from "vuex";
import XContextMenu from "@/components/base/context-menu/XContextMenu.vue";
import {useQuasar} from 'quasar'
import {deleteConnection} from "@/api/connection.js";

const route = useRoute();
const router = useRouter();
const store = useStore();
const $q = useQuasar();
const toast = inject('toast');

const project = ref({});

const connectionsTableColumns = [
    {
        label: "client_id",
        name : "client_id",
        field: "client_id",
    },
    {
        label: "data_center",
        name : "data_center",
        field: "data_center",
    },
    {
        label: "status",
        name : "status",
        field: "status",
    },
    {
        label: "domain",
        name : "domain",
        field: "domain",
    },
    {
        label: "expire",
        name : "expire",
        field: "expire",
    },
    {
        label: "",
        name : "actions",
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

function openEditConnectionHandle({row}) {
    if (!row?.id) {
        return;
    }
    router.push({name: routesName.connection_edit, params: {id: row.id}})
}

function removeConnection({row}) {
    if (!row?.id) {
        return;
    }

    $q.dialog({
        dark      : true,
        title     : 'Confirm',
        message   : 'Would you like remove this connection?',
        cancel    : true,
        persistent: true
    })
        .onOk(() => {
            deleteConnection(row.id)
                .then(() => {
                    toast.success("Connection removed")
                    loadProject()
                })
                .catch(() => toast.error("Something went wrong while removing connection"))
        });
}

onMounted(async () => {
    const project = await loadProject();
    if (!project) {
        await router.push({name: routesName.projects});
    }
    store.commit("SET_PAGE_TITLE", `${project.name} overview`)
    store.commit('ui/SET_CONTEXT_MENU_ITEMS', [
        {
            label  : "New Connection",
            icon   : "add",
            handler: () => router.push({name: routesName.connection_create})
        }
    ])
});
</script>

<template>
    <q-card>
        <q-card-section>
            <div>
                Project Name: {{ project.name }}
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
                                <q-item clickable v-close-popup @click="openEditConnectionHandle(params)">
                                    <q-item-section>
                                        Edit
                                    </q-item-section>
                                </q-item>

                                <q-item clickable v-close-popup @click="removeConnection(params)">
                                    <q-item-section>
                                        Delete
                                    </q-item-section>
                                </q-item>
                            </q-list>
                        </x-context-menu>
                    </q-td>
                </template>
            </q-table>
        </q-card-section>
    </q-card>
</template>

<style scoped>

</style>
