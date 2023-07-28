<script setup>
import {onBeforeMount, onMounted, ref} from "vue";
import * as monaco from "monaco-editor";
import {fetchEditorSuggestions} from "@/api/deluge.js";

const suggestions = ref([]);

const provideCompletionItems = (model, position) => {
    console.log("provideCompletionItems", {model, position});
    const items = suggestions.value.map(i => ({
        label     : i.name,
        kind      : monaco.languages.CompletionItemKind.Text,
        insertText: i.insertText,
    }))

    return {suggestions: items};
}

function init() {
    monaco.languages.registerCompletionItemProvider(
        'php',
        {
            provideCompletionItems: provideCompletionItems
        }
    )

    monaco.languages.register({id: 'blade'})
    monaco.editor.create(
        document.getElementById('monacoEditorContainer'),
        {
            value   : "",
            language: 'php',
            theme   : 'vs-dark',
        });
}

onBeforeMount(async () => {
    const response = await fetchEditorSuggestions()
        .then(({data}) => data)
        .catch(e => console.error(e))

    if (Array.isArray(response)) {
        suggestions.value = response;
    }

    console.log("loadSuggestions", {suggestions: suggestions.value.slice()});
})

onMounted(init)
</script>

<template>
    <div id="monacoEditorContainer" style="height: 800px">

    </div>
</template>

<style scoped>

</style>
