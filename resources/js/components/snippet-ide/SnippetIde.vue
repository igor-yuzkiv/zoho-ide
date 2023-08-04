<script>
import {defineComponent} from "vue";
import CodeEditor from "@/components/snippet-ide/parts/CodeEditor.vue";
import ArgumentsList from "@/components/snippet-ide/parts/ArgumentsList.vue";
import XButton from "@/components/button/XButton.vue";
import XCard from "@/components/card/XCard.vue";
import {Input as XInput} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";

export default defineComponent({
    components: {Icon, XIconButton, XInput, XCard, XButton, ArgumentsList, CodeEditor},
    props     : {
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
            collapsed: false,
            form     : {
                name     : '',
                content  : '',
                arguments: [
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
        }
    },
    computed: {},
    methods : {
        clickSaveHandle() {
            console.log(this.form);
        }
    },
})

</script>

<template>
    <div class="flex items-center justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <x-icon-button @click="collapsed = !collapsed">
            <Icon :icon="collapsed ? 'simple-line-icons:size-fullscreen' : 'simple-line-icons:size-actual'"/>
        </x-icon-button>

        <x-button @click="clickSaveHandle">
            Save
        </x-button>
    </div>
    <div class="grid grid-cols-6 gap-2 flex-grow overflow-hidden">
        <div
            class="col-span-2 flex flex-col flex-gow pr-1 overflow-auto"
            v-show="!collapsed"
        >
            <x-card title="Genereal" expandable>
                <x-input label="Name"/>
            </x-card>

            <arguments-list v-model="form.arguments"></arguments-list>
        </div>
        <code-editor
            :class="{
                'col-span-4': !collapsed,
                'col-span-6': collapsed,
            }"
            :variables="form.arguments"
            theme="vs"
            v-model="form.content"
        />
    </div>
</template>

<style scoped>

</style>
