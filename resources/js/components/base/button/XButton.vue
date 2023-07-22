<script setup>
    defineProps({
        type: {
            type: String,
            default: "button"
        }
    })
</script>

<template>
    <button
        class="inline-block truncate shrink-0 text-center bg-blue-500 p-1 text-white text-base rounded-full focus:ring-2 border border-blue-500"
        :type="type"
    >
        <slot></slot>
    </button>
</template>

<style scoped>

</style>
