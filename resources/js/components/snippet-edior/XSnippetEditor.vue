<script>
import {defineComponent, h, onMounted, onUnmounted, watch} from "vue";
import {fetchDelugeComponents} from "@/api/deluge.js";
import * as monaco from "monaco-editor";
import {SNIPPET_TYPES} from "@/constans/snippet.js";
import editorWorker from 'monaco-editor/esm/vs/editor/editor.worker?worker'
import tsWorker from 'monaco-editor/esm/vs/language/typescript/ts.worker?worker'

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
        modelValue : {
            type   : String,
            default: '',
        },
        id         : {
            type   : String,
            default: "editorContainer"
        },
        theme      : {
            type   : String,
            default: 'vs-dark',
            validator(value) {
                return ['vs', 'vs-dark', 'hc-black'].includes(value);
            }
        },
        variables  : {
            type   : Array,
            default: () => []
        },
        type       : {
            type   : String,
            default: SNIPPET_TYPES.template.name,
            validator(value) {
                return Object.values(SNIPPET_TYPES).map(i => i.name).includes(value);
            }
        },
        suggestions: {
            type   : Array,
            default: () => []
        }
    },
    setup(props, {emit}) {
        let delugeComponents;
        let _editor;
        let _completionProvider;

        async function loadDelugeComponents() {
            await fetchDelugeComponents()
                .then(({data}) => {
                    if (Array.isArray(data)) {
                        delugeComponents = data;
                    }
                })
                .catch(e => console.error(e))
        }

        function provideCompletionItems() {
            const suggestions = [];

            delugeComponents.map(i => {
                suggestions.push({
                    label     : i.name,
                    kind      : monaco.languages.CompletionItemKind.Text,
                    insertText: i?.insertText || '',
                })
            })

            props.variables.map(item => {
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
                    SNIPPET_TYPES.template.language,
                    {provideCompletionItems}
                );

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
        }

        function changeModelLanguage() {
            monaco.editor.setModelLanguage(
                _editor.getModel(),
                SNIPPET_TYPES[props.type].language
            )
        }

        watch(() => props.type, changeModelLanguage)

        onMounted(async () => {
            await loadDelugeComponents();
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
