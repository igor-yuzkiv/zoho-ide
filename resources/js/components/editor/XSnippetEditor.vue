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
                        label:  "deluge-if",
                        kind: monaco.languages.CompletionItemKind.Text,
                        insertText:   "<deluge-if>\n\t<x-slot name='condition'></x-slot>\n\t<x-slot></x-slot>\n</deluge-if>",
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
            value   : "",
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
