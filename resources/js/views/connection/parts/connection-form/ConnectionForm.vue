<script setup>
const defaultForm = () => ({
    project_id   : null,
    client_id    : '',
    client_secret: '',
    data_center  : dataCenters.us,
    scopes       : defaultScopes,
})

import {ref, nextTick, onBeforeMount, inject, computed} from "vue";
import {dataCenters, defaultScopes} from "@/constans/zoho.js"
import ZohoScopes from "@/components/zoho/scopes/ZohoScopes.vue";
import {fetchProjects} from "@/api/project.js";
import {createConnection, updateConnection} from "@/api/connection.js";


const toast = inject('toast');
const emit = defineEmits(['connection:created', 'connection:updated']);
const props = defineProps({
    isEdit    : {
        type   : Boolean,
        default: false,
    },
    connection: {
        type   : Object,
        default: () => {
        },
    }
})

const projects = ref([]);
const isMounted = ref(false);
const form = ref(defaultForm())

const getFormData = computed(() => {
    return {
        ...form.value,
        data_center: form.value.data_center?.location,
        project_id : form.value.project_id?.id,
    }
})


async function createConnectionHandle() {
    return createConnection(getFormData.value)
        .then(({data}) => {
            emit('connection:created', data)
            toast.success('Connection created')
            return data;
        })
        .catch(({response}) => {
            toast.error(response.data?.message || 'Something went wrong while creating connection')
        })
}


async function updateConnectionHandle() {
    return updateConnection(props.connection.id, getFormData.value)
        .then(({data}) => {
            emit('connection:updated', {id: props.connection.id, response:data})
            toast.success('Connection updated')
            return data;
        })
        .catch(({response}) => {
            toast.error(response.data?.message || 'Something went wrong while updating connection')
        })
}

async function submitFormHandle() {
    if (props.isEdit) {
        return updateConnectionHandle()
    }
    return createConnectionHandle()
}

onBeforeMount(async () => {
    await fetchProjects().then(({data}) => {
        if (Array.isArray(data)) {
            projects.value = data
        }
    })

    await nextTick(() => {
        if (props.isEdit) {
            if (!props.connection?.id) {
                toast.error('Invalid connection')
                return;
            }

            const projectObj = projects.value.find(i => i.id === props.connection?.project_id)
            const formValue = {
                ...props.connection,
                data_center: props.connection?.data_center ? dataCenters[props.connection.data_center] : null,
                project_id : projectObj ? projectObj : null,
            };

            form.value = Object.assign({}, defaultForm(), formValue);
        }

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
                <div class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-mt-2 tw-gap-1">
                    <div class="tw-w-full">
                        <q-input
                            label="Client ID"
                            outlined
                            type="password"
                            v-model="form.client_id"
                        />
                    </div>
                    <div class="tw-w-full">
                        <q-input
                            label="Client Secret"
                            outlined
                            type="password"
                            v-model="form.client_secret"
                        />
                    </div>
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
                <q-btn color="blue" @click="submitFormHandle">Submit</q-btn>
            </slot>
        </q-card-actions>
    </q-card>
</template>

<style scoped>

</style>
