<script setup>
const emit = defineEmits(['click']);
const props = defineProps({
    clickable: {
        type   : Boolean,
        default: true
    },
    title    : {
        type   : String,
        default: ''
    },
    minHeight: {
        type   : String,
        default: '200px'
    }
})

function handleClick() {
    if (props.clickable) {
        emit('click')
    }
}

</script>

<template>
    <div
        class="flex flex-col p-2 bg-white dark:bg-gray-800 hover:bg-purple-200 dark:hover:bg-purple-800 rounded-lg shadow-sm relative"
        :style="{'min-height': minHeight}"
        :class="{
            'cursor-pointer': clickable
        }"
    >
        <div class="absolute top-0 left-0 w-full h-2 bg-purple-800 rounded-t-lg"></div>
        <div
            class="flex flex-col flex-grow text-black dark:text-white"
            @click="handleClick"
        >
            <slot name="title">
                <h3 class="truncate text-lg mb-1 font-semibold"> {{ title }} </h3>
            </slot>
            <slot></slot>
        </div>
        <div class="flex items-center border-t pt-2">
            <slot name="actions"></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
