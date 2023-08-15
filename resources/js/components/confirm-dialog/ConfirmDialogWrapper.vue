<script setup>
import {
    isOpen,
    closeDialog,
    confirmHandle,
    cancelHandle,
    options
} from "@/components/confirm-dialog/useConfirmDialogWrapper.js"
import {Modal} from "flowbite-vue";
import XButton from "@/components/form/button/XButton.vue";
import {Icon} from "@iconify/vue";
</script>

<template>
    <Modal v-if="isOpen" @close="closeDialog">
        <template #header>
            <div class="flex items-center gap-2 text-black dark:text-white text-xl font-medium">
                <Icon icon="icon-park-outline:attention"></Icon>
                <h4>{{ options.title }}</h4>
            </div>
        </template>
        <template #body>
            <div class="text-black dark:text-white">
                {{ options.message }}
            </div>
        </template>
        <template #footer>
            <div class="flex items-center justify-between">
                <x-button @click="cancelHandle">
                    Cancel
                </x-button>

                <x-button @click="confirmHandle">
                    Confirm
                </x-button>
            </div>
        </template>
    </Modal>
</template>
