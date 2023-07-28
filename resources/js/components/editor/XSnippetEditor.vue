<script setup>
import {onMounted, ref} from "vue";
import * as monaco from "monaco-editor";
import {fetchComponents} from "@/api/deluge.js";

const props = defineProps({
    modelValue: {
        type   : String,
        default: '',
    },

});
const emit = defineEmits(['update:modelValue']);

const components = ref([]);
const editorInstance = ref(null);

async function loadComponents() {
    const response = await fetchComponents()
        .then(({data}) => data)
        .catch(e => console.error(e))

    if (Array.isArray(response)) {
        components.value = response;
    }
}

// eslint-disable-next-line no-unused-vars
const provideCompletionItems = (model, position) => {
    const items = components.value.map(i => ({
        label     : i.name,
        kind      : monaco.languages.CompletionItemKind.Text,
        insertText: i?.insertText || '',
    }))
    return {suggestions: items};
}

function initEditor() {
    monaco.languages.registerCompletionItemProvider(
        'php',
        {
            provideCompletionItems: provideCompletionItems
        }
    );

    const instance = monaco.editor.create(
        document.getElementById('editorContainer'),
        {
            value   : props.modelValue,
            language: 'php',
            theme   : 'vs-dark',
        }
    );

    instance.onDidChangeModelContent(() => emit('update:modelValue', instance.getValue()));
    editorInstance.value = instance;
}
onMounted(async () => {
    await loadComponents();
    initEditor();
})
</script>

<template>
    <div id="editorContainer" style="height: 500px"></div>
</template>

<style scoped>

</style>
