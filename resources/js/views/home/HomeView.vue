<script setup>

import SnippetEditor from "@/components/snippet-editor/SnippetEditor.vue";
import XCard from "@/components/card/XCard.vue";
</script>

<template>
<div class="grid grid-cols-6 gap-2 flex-grow">
    <x-card title="Arguments" class="col-span-2">

    </x-card>
    <snippet-editor class="col-span-4"></snippet-editor>
</div>
</template>

<style scoped>

</style>
