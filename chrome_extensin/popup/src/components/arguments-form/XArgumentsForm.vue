<script setup>
import XInput from "@/components/input/XInput.vue";
import {ref}  from "vue";

defineProps({
    arguments: {
        type: Array,
        default: () => []
    }
})

const test = {
    label: "Test",
    placeholder: "tesasfdasdsa"
}

const value = ref("");

</script>

<template>
    {{value}}
    <component :is="XInput" v-bind="test" v-model="value"> </component>
</template>

<style scoped>

</style>
