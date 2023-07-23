<script setup>
import {inject, onBeforeMount, onBeforeUnmount, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import routesName from "@/constans/routesName.js";
import {authorizeConnection, getConnection} from "@/api/connection.js";
import ConnectionForm from "@/views/connection/parts/connection-form/ConnectionForm.vue";
import {useQuasar, QSpinnerFacebook} from "quasar";
import {openWindow} from "@/utils/browser.js";

const $q = useQuasar();
const route = useRoute();
const router = useRouter();
const toast = inject('toast');

const isLoaded = ref(false)
const connection = ref({})

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

async function authorizeHandle() {
    const authorization_url = await authorizeConnection(connection.value.id)
        .then(({data}) => data?.url)
        .catch((e) => console.error(e));

    if (!authorization_url || typeof authorization_url !== 'string') {
        toast.error("Something went wrong, try again later.")
        return;
    }

    const newWindow = openWindow('', 'message')
    if (newWindow === undefined) {
        return false;
    }

    newWindow.location.href = authorization_url;

    $q.loading.show({
        spinner: QSpinnerFacebook,
        spinnerColor: 'purple',
        spinnerSize: 140,
        backgroundColor: 'blue',
        message: 'Authorizing...',
        messageColor: 'black'
    })
}

async function onMessage(event) {
    console.log("onMessage", event);
    const {data} = event;
    if (data && data?.from === 'zoho.auth.callback') {
        $q.loading.hide();
        toast.info(data?.message || "Something went wrong");
    }
}


onBeforeMount(async () => {
    const {id} = route.params;
    const connection = await loadConnection(id);
    if(!connection) {
        await router.push({name: routesName.home});
        return;
    }

    window.addEventListener('message', onMessage, false)
    isLoaded.value = true;
});

onBeforeUnmount(() => {
    window.removeEventListener('message', onMessage, false)
})
</script>

<template>
    <div v-if="isLoaded">
        <q-card>
            <q-card-section>
                <div class="tw-flex tw-items-center tw-justify-between">
                    <q-btn @click="router.go(-1)">Back</q-btn>

                    <q-btn color="blue" label="Authorize" @click="authorizeHandle" />
                </div>
            </q-card-section>
        </q-card>


        <q-card class="tw-mt-3">
            <connection-form :isEdit="true" :connection="connection"></connection-form>
        </q-card>
    </div>
</template>

<style scoped>

</style>
