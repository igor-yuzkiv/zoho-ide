<script setup>
import {onMounted, onUnmounted, ref} from "vue";
import {fetchComponents} from "@/api/deluge.js";
import * as monaco from "monaco-editor";

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

onMounted(async () => {
    await loadComponents();
    setTemplateCompletionProvider();

    _editor = monaco.editor.create(
        document.getElementById(props.id),
        {
            value          : props.modelValue,
            language       : 'php',
            theme          : props.theme,
            automaticLayout: true,
        }
    );

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
