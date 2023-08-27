<script setup>
import {Icon} from "@iconify/vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";

defineEmits(['item:click']);
defineProps({
    item    : {
        type    : Object,
        required: true,
    },
    isActive: {
        type   : Boolean,
        default: false
    }
})

</script>

<template>
    <div role="listitem"
         class="cursor-pointer rounded-lg shadow-xs"
         :class="{
                    'bg-purple-200  dark:bg-purple-800 hover:dark:bg-purple-700 hover:bg-purple-100': isActive,
                    'bg-white dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-700': !isActive
                }"
    >
        <div class="flex px-1 py-2 items-center justify-between">
            <div
                class="flex items-center gap-x-1 dark:text-white truncate"
                @click="$emit('item:click', item)"
            >
                <Icon
                    class="text-lg"
                    :icon="SNIPPET_TYPES[item.type]['icon']"
                    :style="{color: SNIPPET_TYPES[item.type]['color']}"
                />
                <div>{{ item.title }}</div>
            </div>
            <div>
                <slot name="actions"></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
