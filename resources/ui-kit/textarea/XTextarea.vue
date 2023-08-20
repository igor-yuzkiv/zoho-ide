<script>
import {defineComponent} from "vue"

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
    <div class="flex flex-col relative w-full focus-within:text-purple-700">
        <slot>
            <label class="text-sm pb-1 dark:text-gray-300 font-medium">{{ label }}</label>
        </slot>

        <textarea
            class="w-full mt-1 p-2 border border-gray-500 bg-gray-100 rounded-md text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:ring-1 focus:ring-purple-700 focus:bg-white dark:focus:bg-cool-gray-700 focus:outline-none focus:shadow-outline-purple"
            :rows="rows"
            :placeholder="placeholder"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        ></textarea>
    </div>
</template>
