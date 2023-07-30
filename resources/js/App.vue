<script setup>

import { initFlowbite } from 'flowbite'
import {onMounted} from "vue";

onMounted(() => {
    initFlowbite()
});

</script>

<template>
    <div class="dark">
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
