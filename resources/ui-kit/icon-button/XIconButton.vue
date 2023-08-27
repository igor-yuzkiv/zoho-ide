<script setup>
import {Icon} from "@iconify/vue";

defineEmits(['click'])
defineProps({
    type: {
        type   : String,
        default: "button"
    },
    icon: {
        type   : String,
        default: "ph:x"
    }
})
</script>

<template>
    <button
        @click="$emit('click', $event)"
        :type="type"
        class="inline-flex items-center justify-center rounded-full shrink-0 p-1 text-gray-800 dark:text-gray-200 hover:bg-gray-700 dark:hover:bg-gray-200 text-md hover:text-gray-200 hover:dark:text-gray-800"
    >
        <slot><Icon :icon="icon"/></slot>
    </button>
</template>

<style scoped>

</style>
