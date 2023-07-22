<script>
export default {
    name: "XListItem",
    emits: ['click'],
}
</script>

<template>
<div
    role="listitem" class="flex items-center justify-between bg-white rounded-xl gap-2 p-3"
    @click="$emit('click', $event)"
>
    <slot name="avatar"></slot>
    <div class="w-full">
        <slot></slot>
    </div>
    <div v-if="$slots.action" class="flex items-center gap-2">
        <slot name="action"></slot>
    </div>
</div>
</template>

<style scoped>

</style>
