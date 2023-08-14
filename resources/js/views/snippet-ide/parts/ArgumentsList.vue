<script setup>
import XCard from "@/components/card/XCard.vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {computed, ref} from "vue";
import ArgumentForm from "@/views/snippet-ide/parts/ArgumentForm.vue";
import {Modal} from "flowbite-vue";
import XChip from "@/components/chip/x-chip.vue";

const emit = defineEmits(['update:modelValue']);
const props = defineProps({
    modelValue: {
        type   : Array,
        default: () => []
    }
})

const argumentFormModal = ref({
    isOpen    : false,
    modelValue: {}
})

const getArguments = computed(() => {
    return props.modelValue.filter(argument => !argument._delete);
})

const getArgumentIndex = (item) => {
    return props.modelValue.findIndex(argument => {
        if (item?.id) {
            return argument.id === item.id
        } else {
            return argument.name === item?.name
        }
    });
}

function handleOpenArgumentModal(item) {
    argumentFormModal.value.isOpen = true;
    argumentFormModal.value.modelValue = item || {};
}

function handleCloseArgumentModal() {
    argumentFormModal.value.isOpen = false;
    argumentFormModal.value.modelValue = {};
}

function handleUpdateArgument(item) {
    const snippetArguments = [...props.modelValue];

    const index = getArgumentIndex(item);
    if (index >= 0) {
        snippetArguments[index] = item;
    } else {
        snippetArguments.push(item);
    }

    emit('update:modelValue', snippetArguments);
    handleCloseArgumentModal();
}

function handleClickDeleteArgument(item) {
    const snippetArguments = [...props.modelValue];
    const index = getArgumentIndex(item);
    if (index >= 0) {
        snippetArguments[index]['_delete'] = true;
        emit('update:modelValue', snippetArguments);
    }
}

</script>

<template>
    <x-card title="Arguments" expandable>
        <template #actions>
            <x-icon-button icon="ph:plus" @click="handleOpenArgumentModal(null)"/>
        </template>

        <ul class="space-y-2">
            <li
                class="flex items-center justify-between border border-gray-200 dark:border-gray-700 rounded-md p-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700"
                role="listitem"
                v-for="item in getArguments"
                :key="item.id"
            >
                <div class="w-full truncate" @click="handleOpenArgumentModal(item)">
                    <h3 class="dark:text-gray-400 text-md font-medium truncate">{{ item.name }}</h3>
                    <span class="text-gray-500 text-sm">{{ item.default }}</span>
                    <div class="flex items-center gap-x-2 mt-2">
                        <x-chip variant="success">{{ item.type }}</x-chip>
                        <x-chip variant="info" v-if="item?.is_slot">slot</x-chip>
                        <x-chip variant="warning" v-if="item?.required">required</x-chip>
                    </div>
                </div>
                <div>
                    <x-icon-button icon="ph:x-bold" @click="handleClickDeleteArgument(item)"/>
                </div>
            </li>
        </ul>
    </x-card>

    <teleport to="#x__application">
        <!--Argument form modal-->
        <Modal v-if="argumentFormModal.isOpen" @close="handleCloseArgumentModal">
            <template #header>
                <div class="text-black dark:text-white">
                    {{ argumentFormModal.modelValue.name || 'New Argument' }}
                </div>
            </template>
            <template #body>
                <argument-form :model-value="argumentFormModal.modelValue" @update:modalValue="handleUpdateArgument"/>
            </template>
        </Modal>
    </teleport>
</template>

<style scoped>

</style>
