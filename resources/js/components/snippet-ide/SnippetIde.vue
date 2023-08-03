<script>
import {defineComponent} from "vue";
import CodeEditor from "@/components/snippet-ide/parts/CodeEditor.vue";
import ArgumentsList from "@/components/snippet-ide/parts/ArgumentsList.vue";
import XButton from "@/components/button/XButton.vue";

export default defineComponent({
    components: {XButton, ArgumentsList, CodeEditor},
    props: {
        isEdit   : {
            type   : Boolean,
            default: false,
        },
        snippetId: {
            type   : String,
            default: null,
        }
    },
    data() {
        return {
            snippetArguments: [
                {
                    name: 'crmModuleName',
                    type: "string",
                },
                {
                    name: "creatorFormName",
                    type: "string",
                }
            ],
        }
    },
    computed: {}
})

</script>

<template>
    <div class="flex items-center justify-end mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">

        <x-button>
            Save
        </x-button>
    </div>
    <div class="grid grid-cols-6 gap-2 flex-grow overflow-hidden">
        <div class="flex flex-col flex-gow gap-2 col-span-2 pr-1 overflow-auto">
            <arguments-list v-model="snippetArguments"></arguments-list>
        </div>

        <code-editor class="col-span-4" :variables="snippetArguments" theme="vs-dark"/>
    </div>
</template>

<style scoped>

</style>
