<script setup>
import {Icon} from "@iconify/vue";

defineProps({
    type: {
        type: String,
        default: "button"
    },
    icon: {
        type: String,
        default: ""
    }
})

defineEmits(['click']);
</script>

<template>
    <button
        :type="type" @click="$emit('click')"
        class="inline-flex items-center shrink-0 rounded-full bg-blue-500 text-xl text-white"
    >
        <Icon :icon="icon" />
    </button>
</template>

<style scoped>

</style>
