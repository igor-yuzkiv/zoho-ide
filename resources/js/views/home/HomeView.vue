<script setup>
import {useStore} from "vuex";
import {onBeforeMount} from "vue";
import XSnippetEditor from "@/components/editor/XSnippetEditor.vue";

const store = useStore();

onBeforeMount(() => {
    store.commit('SET_PAGE_TITLE', 'Home')
    store.commit('ui/SET_CONTEXT_MENU_ITEMS', [])
})

</script>

<style scoped>
</style>

<template>
<x-snippet-editor></x-snippet-editor>
</template>
