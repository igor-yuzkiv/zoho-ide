<script setup>
import {ref, nextTick, onBeforeMount, inject} from "vue";
import {dataCenters, defaultScopes} from "@/constans/zoho.js"
import ZohoScopes from "@/components/zoho/scopes/ZohoScopes.vue";
import {fetchProjects} from "@/api/project.js";
import {createConnection} from "@/api/connection.js";

const emit = defineEmits(['connection:created']);
const toast = inject('toast');

const projects = ref([]);
const isMounted = ref(false);

const defaultForm = () => ({
    project_id   : null,
    client_id    : '',
    client_secret: '',
    data_center  : dataCenters.us,
    scopes       : defaultScopes,
})

const form = ref(defaultForm())

async function createConnectionHandle() {

    const data = {
        ...form.value,
        data_center: form.value.data_center?.location,
        project_id: form.value.project_id?.id,
    }

    await createConnection(data)
        .then(({data}) => {
            emit('connection:created', data)
            toast.success('Connection created')
        })
        .catch(({response}) => {
            toast.error(response.data?.message || 'Something went wrong while creating connection')
        })
}

onBeforeMount(async () => {
    await fetchProjects().then(({data}) => {
        if (Array.isArray(data)) {
            projects.value = data
        }
    })

    await nextTick(() => {
        isMounted.value = true
    });
})

</script>

<template>
    <q-card v-if="isMounted">
        <q-card-section>
            <div>
                <div class="tw-mt-2">
                    <q-select
                        outlined
                        v-model="form.project_id"
                        :options="projects"
                        label="Project"
                        option-label="name"
                        option-value="id"
                    />
                </div>
                <div class="tw-mt-2">
                    <q-input
                        label="Client ID"
                        outlined
                        v-model="form.client_id"
                    />
                </div>
                <div class="tw-mt-2">
                    <q-input
                        label="Client Secret"
                        outlined
                        type="password"
                        v-model="form.client_secret"
                    />
                </div>
                <div class="tw-mt-2">
                    <q-select
                        outlined
                        v-model="form.data_center"
                        :options="Object.values(dataCenters)"
                        label="Data Center"
                        :option-label="i => `${i.title} (${i.domain})`"
                        option-value="domain"
                    />
                </div>

                <div class="tw-mt-3">
                    <zoho-scopes v-model="form.scopes"></zoho-scopes>
                </div>

            </div>
        </q-card-section>
        <q-separator/>
        <q-card-actions class="justify-between">
            <slot name="actions">
                <q-btn> Cancel</q-btn>
                <q-btn color="blue" @click="createConnectionHandle">Submit</q-btn>
            </slot>
        </q-card-actions>
    </q-card>
</template>

<style scoped>

</style>
