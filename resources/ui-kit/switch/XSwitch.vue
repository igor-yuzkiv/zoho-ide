<script setup>
defineEmits(['update:modelValue'])
defineProps({
    modelValue: {
        type   : Boolean,
        default: false
    },
    label     : {
        type   : String,
        default: ''
    }
})
</script>

<template>
    <label class="relative inline-flex items-center cursor-pointer">
        <input
            type="checkbox"
            :checked="modelValue"
            @change="$emit('update:modelValue', $event.target.checked)"
            class="sr-only peer"
        >

        <div
            class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
        />

        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
            <slot>{{ label }}</slot>
        </span>
    </label>
</template>

<style scoped>

</style>
