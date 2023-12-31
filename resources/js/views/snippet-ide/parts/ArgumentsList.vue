<script setup>
import XCard from "@ui-kit/card/XCard.vue";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
import {computed, ref} from "vue";
import ArgumentForm from "@/views/snippet-ide/parts/ArgumentForm.vue";
import XChip from "@ui-kit/chip/x-chip.vue";
import XModal from "@ui-kit/modal/XModal.vue";

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
    argumentFormModal.value = {
        isOpen: true,
        modelValue: item || {},
    };
}

function handleCloseArgumentModal() {
    argumentFormModal.value = {
        isOpen: false,
        modelValue: {},
    };
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
    if (item?.id) {
        const index = getArgumentIndex(item);
        if (index >= 0) {
            const snippetArguments = [...props.modelValue];
            snippetArguments[index]['_delete'] = true;
            emit('update:modelValue', snippetArguments);
        }
    }else {
        const snippetArguments = props.modelValue.filter(argument => argument !== item);
        emit('update:modelValue', snippetArguments);
    }

    setTimeout(() => console.log(props.modelValue), 1000);
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
                    <span class="text-gray-500 text-sm">{{ item.description }}</span>
                    <div class="flex items-center gap-x-2 mt-2">
                        <x-chip variant="success">{{ item.type }}</x-chip>
                        <x-chip variant="info" v-if="item?.is_slot">slot</x-chip>
                        <x-chip variant="warning" v-if="item?.is_required">required</x-chip>
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
        <x-modal :model-value="argumentFormModal.isOpen" @close="handleCloseArgumentModal" :dialogClass="{'sm:w-3/6': true}">
            <template #header>
                <div class="text-black dark:text-white">
                    {{ `Argument: ${argumentFormModal.modelValue.name}` || 'New Argument' }}
                </div>
            </template>
            <argument-form :model-value="argumentFormModal.modelValue" @update:modalValue="handleUpdateArgument"/>
        </x-modal>
    </teleport>
</template>

<style scoped>

</style>
