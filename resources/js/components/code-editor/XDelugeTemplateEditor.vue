<script>
import {defineComponent, h, onMounted, onUnmounted, ref, watch} from "vue";
import * as monaco from "monaco-editor";
import editorWorker from 'monaco-editor/esm/vs/editor/editor.worker?worker'
import tsWorker from 'monaco-editor/esm/vs/language/typescript/ts.worker?worker'
import {fetchIdeSuggestions} from "@/api/ide.js";

const EDITOR_LANGUAGE = "php";

self.MonacoEnvironment = {
    getWorker(_, label) {
        if (label === 'javascript' || label === 'typescript') {
            return new tsWorker()
        }
        return new editorWorker()
    }
}

export default defineComponent({
    emits: ['update:modelValue'],
    props: {
        modelValue      : {
            type   : String,
            default: '',
        },
        id              : {
            type   : String,
            default: "editorContainer"
        },
        theme           : {
            type   : String,
            default: 'vs-dark',
            validator(value) {
                return ['vs', 'vs-dark', 'hc-black'].includes(value);
            }
        },
        snippetArguments: {
            type   : Array,
            default: () => []
        },
    },
    setup(props, {emit}) {
        const ideSuggestions = ref([]);
        let _editor;
        let _completionProvider;

        async function loadIdeSuggestions() {
            await fetchIdeSuggestions()
                .then(({data}) => {
                    if (Array.isArray(data)) {
                        ideSuggestions.value = data;
                    }
                })
                .catch(e => console.error(e))
        }

        function provideCompletionItems() {
            const suggestions = ideSuggestions.value.map(i => {
                return {...i};
            })

            props.snippetArguments.map(item => {
                const insertText = item?.is_slot
                    ? '{!! $' + item.name + ' !!}'
                    : '{{$' + item.name + '}}'

                suggestions.push({
                    label     : '$' + item.name,
                    kind      : monaco.languages.CompletionItemKind.Variable,
                    insertText: insertText,
                })
            })

            return {suggestions};
        }

        function initEditor() {
            _completionProvider = monaco.languages
                .registerCompletionItemProvider(
                    EDITOR_LANGUAGE,
                    {provideCompletionItems}
                );

            _editor = monaco.editor.create(
                document.getElementById(props.id),
                {
                    value          : props.modelValue,
                    language       : EDITOR_LANGUAGE,
                    theme          : props.theme,
                    automaticLayout: true,
                }
            );

            _editor.onDidChangeModelContent(() => emit('update:modelValue', _editor.getValue()));
        }

        function declareComponentProps() {
            const regex = /@props\(\[\s*('[^']*'\s*,?\s*)*\s*\]\)\n*/g;
            const content = _editor.getValue().replace(regex, "");
            console.log(props.snippetArguments);
            const componentProps = new Set();
            for (const item of props.snippetArguments.filter(i => !i?.is_slot)) {
                componentProps.add(`\t'${item.name}',\n`)
            }

            if (!componentProps.size) {
                _editor.setValue(content);
                return;
            }

            _editor.setValue(`@props([\n${[...componentProps].join('')}])\n${content}`);
        }

        watch(() => props.snippetArguments, declareComponentProps)

        onMounted(async () => {
            await loadIdeSuggestions();
            initEditor();
        })

        onUnmounted(() => {
            _editor.dispose()
            _completionProvider.dispose();
        })

        return () => h('div', {id: props.id})
    }
})
</script>
