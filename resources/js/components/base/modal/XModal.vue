<script setup>
import {Icon} from "@iconify/vue";

defineEmits(['update']);
const props = defineProps({
    value: {
        type: Boolean,
        default: false
    },
    width: {
        type: String,
        default: "w-2/6"
    },
    title: {
        type: String,
        default: ""
    }
})


</script>

<template>
    <transition name="fade">
        <div
            class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-black bg-opacity-60 flex flex-col items-center justify-center"
            v-if="value"
        >
            <div class="relative bg-white rounded-3xl" :class="width">
                <div
                    class="flex items-center justify-between rounded-t-3xl text-md text-white font-semibold bg-gigas-500 pl-4 pr-2 py-2"
                >
                    <div>
                        <slot name="header">
                            {{ title }}
                        </slot>
                    </div>

                    <button
                        type="button"
                        class="inline-flex shrink-0 rounded-full p-1 hover:bg-gigas-400 hover:text-gigas-700"
                        @click="$emit('update', !value)"
                    >
                        <Icon icon="ic:round-close" class="text-xl"></Icon>
                    </button>
                </div>

                <div class="flex flex-col p-4 w-full">
                    <slot></slot>
                </div>

                <div v-if="$slots.actions" class="p-2 border-t">
                    <slot name="actions"></slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
</style>
