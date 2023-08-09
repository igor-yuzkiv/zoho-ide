<script setup>
import * as monaco from 'monaco-editor'
import editorWorker from 'monaco-editor/esm/vs/editor/editor.worker?worker'
import tsWorker from 'monaco-editor/esm/vs/language/typescript/ts.worker?worker'
import htmlWorker from 'monaco-editor/esm/vs/language/html/html.worker.js?worker'

self.MonacoEnvironment = {
    getWorker(_, label) {
        if (label === 'javascript' || label === 'typescript') {
            return new tsWorker()
        }
        return new editorWorker()
    }
}

import {computed, onMounted, onUnmounted, ref, watch} from "vue";
import {fetchComponents} from "@/api/deluge.js";
import {SNIPPET_TYPES} from "@/constans/snippet.js";

const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: {
        type   : String,
        default: '',
    },
    id        : {
        type   : String,
        default: "editorContainer"
    },
    theme     : {
        type   : String,
        default: 'vs-dark',
        validator(value) {
            return ['vs', 'vs-dark', 'hc-black'].includes(value);
        }
    },
    variables : {
        type   : Array,
        default: () => []
    },
    type      : {
        type   : String,
        default: SNIPPET_TYPES.template.name,
        validator(value) {
            return Object.values(SNIPPET_TYPES).map(i => i.name).includes(value);
        }
    }
})
const components = ref([]);
let _editor;
let _completionProvider;

async function loadComponents() {
    const response = await fetchComponents()
        .then(({data}) => data)
        .catch(e => console.error(e))

    if (Array.isArray(response)) {
        components.value = response;
    }
}

function setTemplateCompletionProvider() {
    _completionProvider = monaco.languages.registerCompletionItemProvider(
        'php',
        {
            provideCompletionItems: () => {
                const suggestions = components.value.map(i => ({
                    label     : i.name,
                    kind      : monaco.languages.CompletionItemKind.Text,
                    insertText: i?.insertText || '',
                }))

                for (const item of props.variables) {
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
        }
    );
}

watch(
    () => props.type,
    () => monaco.editor.setModelLanguage(_editor.getModel(), SNIPPET_TYPES[props.type].language)
)

onMounted(async () => {
    await loadComponents();
    setTemplateCompletionProvider();

    _editor = monaco.editor.create(
        document.getElementById(props.id),
        {
            value          : props.modelValue,
            language       : SNIPPET_TYPES[props.type].language,
            theme          : props.theme,
            automaticLayout: true,
        }
    );

    monaco.languages.typescript.typescriptDefaults.setDiagnosticsOptions({
        noSemanticValidation: true,
        noSyntaxValidation  : true,
    });

    _editor.onDidChangeModelContent(() => emit('update:modelValue', _editor.getValue()));
})

onUnmounted(() => {
    _editor.dispose()
    _completionProvider.dispose();
})
</script>

<template>
    <div :id="id"/>
</template>
