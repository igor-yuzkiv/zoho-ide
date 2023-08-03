<script>
import {defineComponent, h} from "vue";
import * as monaco from "monaco-editor";
import {fetchComponents} from "@/api/deluge.js";

export default defineComponent({
    props: {
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
    },
    emits: ["update:modelValue"],
    data() {
        return {
            components    : [],
            editorInstance: null,
        }
    },
    async beforeMount() {
        await this.loadComponents();
    },
    mounted() {
        this.initEditor();
    },
    methods: {
        async loadComponents() {
            const response = await fetchComponents()
                .then(({data}) => data)
                .catch(e => console.error(e))

            if (Array.isArray(response)) {
                this.components = response;
            }
        },
        provideCompletionItems() {
            const suggestions = this.components.map(i => ({
                label     : i.name,
                kind      : monaco.languages.CompletionItemKind.Text,
                insertText: i?.insertText || '',
            }))

            for (const item of this.variables) {
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
        },
        initEditor() {
            monaco.languages.registerCompletionItemProvider(
                'php',
                {
                    provideCompletionItems: this.provideCompletionItems
                }
            );

            const instance = monaco.editor.create(
                document.getElementById('editorContainer'),
                {
                    value   : this.modelValue,
                    language: 'php',
                    theme   : this.theme,
                }
            );

            instance.onDidChangeModelContent(() => this.$emit('update:modelValue', instance.getValue()));
            this.editorInstance = instance;
        }
    },
    setup(props) {
        return () => h("div", {
            id   : props.id,
            class: "x__monacoEditor h-full"
        })
    },
})
</script>
