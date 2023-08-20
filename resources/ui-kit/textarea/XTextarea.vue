<script>
import {defineComponent, h} from "vue"

export default defineComponent({
    props: {
        label: {
            type: String,
            default: "",
        },
        modelValue: {
            type: String,
            default: '',
        },
        rows: {
            type: String,
            default: '3',
        },
        placeholder: {
            type: String,
            default: '',
        }
    },
});
</script>

<template>
    <label class="block mt-4 text-sm">
        <slot name="label">
            <span class="text-gray-700 dark:text-gray-400">{{ label }}</span>
        </slot>
        <textarea
            class="block w-full mt-1 rounded-md text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
            :rows="rows"
            :placeholder="placeholder"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        ></textarea>
    </label>
</template>
