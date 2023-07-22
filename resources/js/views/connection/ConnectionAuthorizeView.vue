<script setup>

import {computed, onBeforeMount, ref, onBeforeUnmount, inject} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import routesName from "@/constans/routesName.js";
import {getConnection} from "@/api/connection.js";
import {openWindow} from "@/utils/browser.js";
const store = useStore();
const route = useRoute();
const router = useRouter();
const toast = inject("toast");

const connection = ref({});
const authProcess = ref(false);

const projectName = computed(() => connection.value.project?.name || '');

async function loadConnection() {
    const {id: connectionId}  = route.params;
    if (!connectionId) {
        return;
    }

    return getConnection(connectionId, ['project'])
        .then(({data}) => {
            if (data) {
                connection.value = data;
                return data;
            }
        })
        .catch(e => console.error(e))
}

async function onMessage(event) {
    console.log("onMessage", event);
    const {data} = event;

    toast.info(data?.message || "Something went wrong");

    if (data && data?.from === 'zoho.auth.callback') {
        authProcess.value = false;
        if (data?.status === 'success' && data?.id === connection.value.id) {
            await router.push({name: routesName.projects});
        }
    }
}

function startAuthProcessHandle() {
    const {authorization_url} = connection.value;
    if (!authorization_url) {
        return;
    }

    const newWindow = openWindow('', 'message')
    if (newWindow === undefined) {
        return false;
    }

    authProcess.value = true;
    newWindow.location.href = authorization_url;
}

onBeforeMount(async () => {
    const connection = await loadConnection();

    if (!connection) {
        await router.push({name: routesName.home});
        return;
    }
    window.addEventListener('message', onMessage, false)
    store.commit("SET_PAGE_TITLE", `[id: ${connection.id}] Authorize ${projectName.value} connection`);
    store.commit("ui/SET_CONTEXT_MENU_ITEMS", []);
})

onBeforeUnmount(() => {
    window.removeEventListener('message', onMessage, false)
})
</script>

<template>
    <div class="tw-mt-2 tw-p-3 tw-bg-white tw-shadow-2xl tw-rounded-xl">
        <div class="tw-text-center tw-my-4 tw-text-2xl tw-font-semibold">
            {{projectName}}
        </div>
        <div
            class="tw-flex tw-items-center tw-justify-center"
            v-if="authProcess"
        >
            <q-spinner size="100" color="blue"></q-spinner>
        </div>
        <div
            class="tw-flex tw-flex-col tw-justify-center"
            v-else
        >
            <q-btn
                color="blue"
                @click="startAuthProcessHandle"
            >
                Authorize
            </q-btn>
        </div>
    </div>
</template>

<style scoped>

</style>
