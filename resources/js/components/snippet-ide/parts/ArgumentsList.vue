<script setup>
import {reactive} from "vue";
import XCard from "@/components/card/XCard.vue";
import {Button, Input, ListGroup, ListGroupItem, Modal, Select} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";

const props = defineProps({
    modelValue: {
        type   : Array,
        default: () => []
    }
});
const emit = defineEmits(['update:modelValue']);

const argumentForm = reactive({
    isOpen: false,
    name  : '',
    type  : '',
});

function submitArgumentHandle() {
    emit('update:modelValue', [
        ...props.modelValue,
        {
            name: argumentForm.name,
            type: argumentForm.type,
        }
    ])
    argumentForm.isOpen = false;
}

function openArgumentForm(item) {
    argumentForm.isOpen = true;
    argumentForm.name = item?.name || '';
    argumentForm.type = item?.type || 'string';
}

function deleteArgument(item) {
    emit('update:modelValue', props.modelValue.filter(i => i.name !== item.name));
}

const argumentsTypes = [
    {
        name : 'string',
        value: 'string',
    },
    {
        name : 'number',
        value: 'number',
    },
    {
        name : 'boolean',
        value: 'boolean',
    },
    {
        name : 'any',
        value: 'any',
    },
];

</script>

<template>
    <x-card title="Arguments" expandable>
        <template #actions>
            <x-icon-button icon="ph:plus" @click="openArgumentForm(null)"/>
        </template>

        <ListGroup class="w-full">
            <ListGroupItem
                v-for="item in modelValue"
                :key="item.name"
                class="flex items-center justify-between"
            >
                <div class="flex flex-col v-full" @click="openArgumentForm(item)">
                    <span>{{ item.name }}</span>
                    <span class="text-black">type: {{ item.type }}</span>
                </div>
                <x-icon-button icon="ph:x-bold" @click="deleteArgument(item)"/>
            </ListGroupItem>
        </ListGroup>
    </x-card>

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
