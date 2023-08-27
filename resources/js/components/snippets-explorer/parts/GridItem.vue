<script setup>
import XChip from "@ui-kit/chip/x-chip.vue";
import XTile from "@ui-kit/tile/XTile.vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";

defineEmits(['item:click', 'item:delete']);
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
            <x-icon-button
                icon="ic:baseline-delete"
                @click="$emit('item:delete', item)"
            />
        </template>
    </x-tile>
</template>

<style scoped>

</style>
