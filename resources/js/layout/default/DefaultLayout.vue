<script setup>
import {ref} from "vue";
import LeftSidebar from "@/layout/default/parts/left-sidebar/LeftSidebar.vue";
import DefaultHeader from "@/layout/default/parts/header/DefaultHeader.vue";
const isSideMenuOpen = ref(false)

</script>

<template>
    <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        <left-sidebar></left-sidebar>

        <div class="flex flex-col flex-1 w-full">
            <default-header></default-header>

            <main class="flex flex-col flex-grow overflow-hidden p-2">
               <router-view></router-view>
            </main>
        </div>
    </div>

</template>

<style scoped>

</style>
