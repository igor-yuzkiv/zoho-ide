<script setup>
import XChip from "@ui-kit/chip/x-chip.vue";
import XTile from "@ui-kit/tile/XTile.vue";
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
    <x-tile
        :title="item.title"
        :clickable="true"
        @click="$emit('item:click', item)"
    >
        <template #default>
            <div class="flex flex-col flex-grow text-sm text-gray-500 mt-1">
                {{ item.description }}
            </div>
            <div class="flex flex-col items-start mb-1">
                <x-chip
                    :variant="SNIPPET_TYPES[item.type]['variant']"
                >
                    {{ item.type }}
                </x-chip>
            </div>
        </template>

        <template #actions>
            <div class="flex items-center justify-end w-full">
                <slot name="actions"></slot>
            </div>
        </template>
    </x-tile>
</template>

<style scoped>

</style>
