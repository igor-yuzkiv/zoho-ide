<script setup>
import {
    isOpen,
    closeDialog,
    confirmHandle,
    cancelHandle,
    options
} from "@ui-kit/confirm-dialog/useConfirmDialogWrapper.js"
import XButton from "@ui-kit/button/XButton.vue";
import {Icon} from "@iconify/vue";
import XModal from "@ui-kit/modal/XModal.vue";
</script>

<template>
    <x-modal :model-value="isOpen" @close="closeDialog">
        <template #header>
            <div class="flex items-center gap-2 text-black dark:text-white text-xl font-medium">
                <Icon icon="icon-park-outline:attention"></Icon>
                <h4>{{ options.title }}</h4>
            </div>
        </template>
        <div class="text-black dark:text-white">
            {{ options.message }}
        </div>
        <template #footer>
            <x-button @click="cancelHandle">
                Cancel
            </x-button>

            <x-button @click="confirmHandle">
                Confirm
            </x-button>
        </template>
    </x-modal>
</template>
