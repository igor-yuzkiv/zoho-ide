<script>
import {defineComponent} from "vue";
import CodeEditor from "@/components/code-editor/CodeEditor.vue";
import XButton from "@/components/button/XButton.vue";
import XCard from "@/components/card/XCard.vue";
import {Input as XInput, ListGroup, ListGroupItem} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";

export default defineComponent({
    components: {ListGroupItem, ListGroup, Icon, XIconButton, XInput, XCard, XButton, CodeEditor},
    props     : {
        snippetId: {
            type    : String,
            required: true,
        }
    },
    beforeMount() {

    },
    data() {
        return {
            collapsed: false,
            snippet  : {
                name   : '',
                content: '',
                arguments: []
            },

        }
    },
    computed: {},
    methods : {
        clickSaveHandle() {
            console.log(this.form);
        },

        deleteArgumentHandle(item) {
            //TODO:...
            console.log("deleteArgumentHandle", item);
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
            class="col-span-2 flex flex-col flex-gow gap-2 pr-1 overflow-auto"
            v-show="!collapsed"
        >
            <x-card title="General" expandable>
                <x-input label="Name"/>
            </x-card>

            <x-card title="Arguments" expandable>
                <template #actions>
                    <x-icon-button icon="ph:plus"/>
                </template>

                <ListGroup class="w-full">
                    <ListGroupItem
                        v-for="item in snippet.arguments"
                        :key="item.name"
                        class="flex items-center justify-between"
                    >
                        <div class="flex flex-col v-full">
                            <span>{{ item.name }}</span>
                            <span class="text-black">type: {{ item.type }}</span>
                        </div>
                        <x-icon-button icon="ph:x-bold" @click="deleteArgumentHandle(item)"/>
                    </ListGroupItem>
                </ListGroup>
            </x-card>
        </div>

        <code-editor
            :class="{
                'col-span-4': !collapsed,
                'col-span-6': collapsed,
            }"
            :variables="arguments"
            theme="vs"
            v-model="snippet.content"
        />
    </div>
</template>

<style scoped>

</style>
