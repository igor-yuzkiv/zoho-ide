<script setup>
import {useStore} from "vuex";
import {onBeforeMount, ref} from "vue";
import XSnippetEditor from "@/components/editor/XSnippetEditor.vue";
import {createSnippet} from "@/api/deluge.js"

const store = useStore();

onBeforeMount(() => {
    store.commit('SET_PAGE_TITLE', 'Home')
    store.commit('ui/SET_CONTEXT_MENU_ITEMS', [])
})

const snippet = ref("");

async function saveSnippet() {
    await createSnippet({
        name   : "test1",
        content: snippet.value,
    })
        .then(response => console.log(response))
}
</script>

<style scoped>
</style>

<template>
    <div class="tw-flex tw-items-center tw-justify-end">
        <q-btn @click="saveSnippet" color="blue">
            Save
        </q-btn>
    </div>
    <div class="tw-mt-2">
        <x-snippet-editor v-model="snippet"/>
    </div>
</template>
