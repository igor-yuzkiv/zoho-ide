<script setup>
import {ref} from "vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";

const props = defineProps({
    title     : {
        type   : String,
        default: '',
    },
    expandable: {
        type   : Boolean,
        default: false,
    },
})

const isExpanded = ref(true);
function toggleExpand() {
    if (!props.expandable) return;
    isExpanded.value = !isExpanded.value;
}
</script>

<template>
    <div
        class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
        <div class="flex items-center justify-between">
            <div class="w-full" @click="toggleExpand">
                <slot name="title">
                    <h4
                        class="font-semibold text-gray-600 dark:text-gray-300"
                        :class="{'mb-2' : isExpanded}"
                    >
                        {{ title }}
                    </h4>
                </slot>
            </div>
            <div class="flex items-center gap-x-1">
                <x-icon-button
                    v-if="expandable"
                    @click="toggleExpand"
                    :icon="isExpanded ? 'tabler:chevron-up' : 'tabler:chevron-down'"
                />
                <slot name="actions"></slot>
            </div>
        </div>
        <div v-show="isExpanded" class="p-1">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
