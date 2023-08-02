<script setup>

import SnippetEditor from "@/components/snippet-editor/SnippetEditor.vue";
import XCard from "@/components/card/XCard.vue";
import {Button, Input, ListGroup, ListGroupItem, Modal, Select} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {reactive, ref} from "vue";


const argumentForm = reactive({
    isOpen: false,
    name  : '',
    type  : '',
});

function submitArgumentHandle() {
    snippetArguments.value = [
        ...snippetArguments.value,
        {
            name: argumentForm.name,
            type: argumentForm.type,
        }
    ]
    argumentForm.isOpen = false;
}

function openArgumentForm(item) {
    argumentForm.isOpen = true;
    argumentForm.name = item?.name || '';
    argumentForm.type = item?.type || 'string';
}

function deleteArgiment(item) {
    snippetArguments.value = snippetArguments.value.filter(i => i.name !== item.name);
}

const argumentsTypes = [
    {
        name: 'string',
        value: 'string',
    },
    {
        name: 'number',
        value: 'number',
    },
    {
        name: 'boolean',
        value: 'boolean',
    },
    {
        name: 'any',
        value: 'any',
    },
];

const snippetArguments = ref([
    {
        name: 'crmModuleName',
        type: "string",
    },
    {
        name: "creatorFormName",
        type: "string",
    }
]);

</script>

<template>
    <div class="grid grid-cols-6 gap-2 flex-grow overflow-hidden">
        <div class="flex flex-col flex-gow gap-2 col-span-2 pr-1 overflow-auto">
            <x-card title="Arguments" expandable>
                <template #actions>
                    <x-icon-button icon="ph:plus" @click="openArgumentForm"/>
                </template>

                <ListGroup class="w-full">
                    <ListGroupItem
                        v-for="item in snippetArguments"
                        :key="item.name"
                        class="flex items-center justify-between"
                    >
                        <div class="flex flex-col v-full"  @click="openArgumentForm(item)">
                            <span>{{ item.name }}</span>
                            <span class="text-black">type: {{ item.type }}</span>
                        </div>
                        <x-icon-button icon="ph:x-bold" @click="deleteArgiment(item)"/>
                    </ListGroupItem>
                </ListGroup>
            </x-card>
            <x-card title="Arguments" expandable>
                asd
            </x-card>
        </div>
        <snippet-editor class="col-span-4"></snippet-editor>
    </div>

    <!--Argument Form-->
    <Modal v-if="argumentForm.isOpen" @close="argumentForm.isOpen = false">
        <template #header>Add Arguments</template>
        <template #body>
            <Input label="Name" v-model="argumentForm.name"/>
            <Select label="Type" v-model="argumentForm.type" :options="argumentsTypes"/>
        </template>
        <template #footer>
            <Button @click="submitArgumentHandle" type="button">Add</Button>
        </template>
    </Modal>
</template>

<style scoped>

</style>
