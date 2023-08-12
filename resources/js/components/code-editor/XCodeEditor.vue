<script>
import {defineComponent, h, onMounted} from "vue";
import * as monaco from "monaco-editor";
import editorWorker from 'monaco-editor/esm/vs/editor/editor.worker?worker'
import tsWorker from 'monaco-editor/esm/vs/language/typescript/ts.worker?worker';

self.MonacoEnvironment = {
    getWorker(_, label) {
        if (label === 'javascript' || label === 'typescript') {
            return new tsWorker()
        }
        return new editorWorker()
    }
}

export default defineComponent({
    emits: ["update:modelValue"],
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
    },
    setup(props, {emit}) {
        let _editor;

        onMounted(async () => {
            _editor = monaco.editor.create(
                document.getElementById(props.id),
                {
                    value          : props.modelValue,
                    language       : "typescript",
                    theme          : props.theme,
                    automaticLayout: true,
                }
            );

            monaco.languages.typescript.typescriptDefaults.setDiagnosticsOptions({
                noSemanticValidation: true,
                noSyntaxValidation  : true,
            });

            _editor.onDidChangeModelContent(() => emit('update:modelValue', _editor.getValue()));
        });

        return () => h('div', {id: props.id})
    }
});
</script>
