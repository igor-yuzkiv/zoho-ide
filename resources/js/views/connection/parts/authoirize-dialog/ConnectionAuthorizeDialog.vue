<script setup>

import {onBeforeMount, ref, onBeforeUnmount, inject} from "vue";
import {getConnection} from "@/api/connection.js";
import {openWindow} from "@/utils/browser.js";

const toast = inject("toast");
const emit = defineEmits(["success"]);

const isOpen = ref(false);
const connection = ref({});
const authProcess = ref(false);

async function openDialog(connectionId) {
    const connection = await loadConnection(connectionId);
    if (!connection) {
        toast.error('Invalid connection');
        return;
    }
    isOpen.value = true;
    //startAuthProcessHandle();
}

async function loadConnection(connectionId) {
    return getConnection(connectionId)
        .then(({data}) => {
            if (data) {
                connection.value = data;
                return data;
            }
        })
        .catch(e => console.error(e))
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

async function onMessage(event) {
    console.log("onMessage", event);
    const {data} = event;
    if (data && data?.from === 'zoho.auth.callback') {
        toast.info(data?.message || "Something went wrong");
        authProcess.value = false;
        if (data?.status === 'success' && data?.id === connection.value.id) {
            emit("success", data);
            isOpen.value = false;
        }
    }
}

onBeforeMount(async () => {
    window.addEventListener('message', onMessage, false)
})

onBeforeUnmount(() => {
    window.removeEventListener('message', onMessage, false)
})

defineExpose({
    open: openDialog,
})
</script>

<template>
    <q-dialog v-model="isOpen" persistent>
        <div class="tw-mt-2 tw-p-3 tw-bg-white tw-shadow-2xl tw-rounded-xl tw-w-[200px] tw-h-[135px]">
            <div class="tw-flex tw-items-center tw-justify-center">
                <q-spinner size="100" color="blue"></q-spinner>
            </div>
        </div>
    </q-dialog>
</template>

<style scoped>

</style>
