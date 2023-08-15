<script setup>

import XInput from "@/components/form/input/XInput.vue";

const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: {
        type   : Object,
        default: () => ({
            key  : '',
            value: '',
        })
    },
});

function onItemChanged(field, fieldValue) {
    const value = {...props.modelValue};
    value[field] = fieldValue;
    emit("update:modelValue", value);
}

</script>

<template>
    <li class="flex items-center gap-x-2">
        <x-input
            label="Key"
            :model-value="modelValue?.key || ''"
            @update:model-value="onItemChanged('key', $event)"
        />

        <x-input
            label="Value"
            :model-value="modelValue?.value || ''"
            @update:model-value="onItemChanged('value', $event)"
        />
    </li>
</template>

<style scoped>

</style>
