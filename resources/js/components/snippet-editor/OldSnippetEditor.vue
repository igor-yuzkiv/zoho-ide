<script setup>
import {onMounted, ref} from "vue";
import * as monaco from "monaco-editor";
import {fetchComponents} from "@/api/deluge.js";

const props = defineProps({
    modelValue: {
        type   : String,
        default: '',
    },
    height    : {
        type   : String,
        default: "500px"
    },
    theme     : {
        type   : String,
        default: 'vs-dark',
        validator(value) {
            return ['vs', 'vs-dark', 'hc-black'].includes(value);
        }
    },
    arguments : {
        type   : Array,
        default: () => []
    }
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
const provideCompletionItems = (model, position, context) => {
    const suggestions = components.value.map(i => ({
        label     : i.name,
        kind      : monaco.languages.CompletionItemKind.Text,
        insertText: i?.insertText || '',
    }))


    for (const item of props.arguments) {
        if (!item?.name) {
            continue;
        }

        suggestions.push({
            label     : '$' + item.name,
            kind      : monaco.languages.CompletionItemKind.Variable,
            insertText: '{{$' + item.name + '}}'
        })
    }

    return {suggestions};
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
            theme   : props.theme,
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
    <div id="editorContainer" :style="{height}"></div>
</template>

<style scoped>

</style>
