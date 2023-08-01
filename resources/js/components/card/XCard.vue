<script setup>
defineProps({
    title: {
        type: String,
        default: '',
    }
})

</script>

<template>
    <div
        class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
        <slot name="title">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                {{ title }}
            </h4>
        </slot>
        <slot></slot>
    </div>
</template>

<style scoped>

</style>
