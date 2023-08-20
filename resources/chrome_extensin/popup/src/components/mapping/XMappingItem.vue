<script setup>

import XInput from "@ui-kit/input/XInput.vue";
import {computed} from "vue";

const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    modelValue: {
        type   : Object,
        default: () => ({
            name : '',
            value: '',
        })
    },
});

const itemName = computed(() => props.modelValue?.name || '');
const itemValue = computed(() => props.modelValue?.value || '');

function onChangeItem(name, value) {
    const result = {...props.modelValue}
    result[name] = value;

    emit('update:modelValue', result);
}
</script>

<template>
    <li class="flex items-center gap-x-2">
        <x-input
            label="Name"
            :model-value="itemName"
            @update:model-value="onChangeItem('name', $event)"
        />

        <x-input
            label="Value"
            :model-value="itemValue"
            @update:model-value="onChangeItem('value', $event)"
        />
    </li>
</template>

<style scoped>

</style>
