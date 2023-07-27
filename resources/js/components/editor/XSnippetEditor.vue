<script setup>
import {onMounted} from "vue";
import * as monaco from "monaco-editor";

function init() {
    monaco.languages.registerCompletionItemProvider(
        'php',
        {
            provideCompletionItems: (model, position) => {
                console.log(model, position);
                const suggestions = [
                    {
                        label:  "if statement",
                        kind: monaco.languages.CompletionItemKind.Text,
                        insertText:   "<x-if condition=\"{{ $condition }}\"> </x-if>",
                    }
                ];

                return {suggestions}
            }
        }
    )

    monaco.languages.register({id: 'blade'})
    monaco.editor.create(
        document.getElementById('monacoEditorContainer'),
        {
            value   : 'console.log("Hello, world")',
            language: 'php',
            theme   : 'vs-dark',
        });
}

onMounted(init)
</script>

<template>
    <div id="monacoEditorContainer" style="height: 800px">

    </div>
</template>

<style scoped>

</style>
