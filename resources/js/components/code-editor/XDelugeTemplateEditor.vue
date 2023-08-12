<script>
import {defineComponent, h, onMounted, onUnmounted, ref, watch} from "vue";
import * as monaco from "monaco-editor";
import editorWorker from 'monaco-editor/esm/vs/editor/editor.worker?worker'
import tsWorker from 'monaco-editor/esm/vs/language/typescript/ts.worker?worker'
import {fetchIdeSuggestions} from "@/api/snippets.js";

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
        modelValue   : {
            type   : String,
            default: '',
        },
        id           : {
            type   : String,
            default: "editorContainer"
        },
        theme        : {
            type   : String,
            default: 'vs-dark',
            validator(value) {
                return ['vs', 'vs-dark', 'hc-black'].includes(value);
            }
        },
        componentProps: {
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

            props.componentProps.map(item => {
                suggestions.push({
                    label     : '$' + item.name,
                    kind      : monaco.languages.CompletionItemKind.Variable,
                    insertText: '{{$' + item.name + '}}'
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

            monaco.languages.typescript.typescriptDefaults.setDiagnosticsOptions({
                noSemanticValidation: true,
                noSyntaxValidation  : true,
            });

            _editor.onDidChangeModelContent(() => emit('update:modelValue', _editor.getValue()));
        }

        function declareComponentProps() {
            const regex = /@props\(\[\s*('[^']*'\s*,?\s*)*\s*\]\)\n*/g;
            const content = _editor.getValue().replace(regex, "");

            if (!props.componentProps?.length) {
                _editor.setValue(content);
                return;
            }

            let propsString = '';
            for (const item of props.componentProps) {
                propsString += `\t'${item.name}',\n`;
            }
            propsString = `@props([\n${propsString}])`;

            _editor.setValue(propsString + '\n' + content);
        }

        watch(() => props.componentProps, declareComponentProps)

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
