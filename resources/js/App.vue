<script setup>

import {initFlowbite} from 'flowbite'
import {computed, onMounted} from "vue";
import {useStore} from "vuex";


const store = useStore();

const darkTheme = computed(() => store.state.darkTheme);

onMounted(() => {
    initFlowbite()
});

</script>

<template>
    <div :class="{dark:darkTheme}">
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
