<script setup>

import NavSidebar from "@/layout/default/NavSidebar.vue";
import NavHeader from "@/layout/default/NavHeader.vue";
</script>

<template>
    <div class="min-h-screen flex flex-col h-screen">
        <nav-header></nav-header>
        <nav-sidebar></nav-sidebar>
        <main class="flex flex-row flex-1 overflow-hidden p-2 sm:ml-64">
            <!--flex flex-col flex-grow p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14-->
            <div class="flex-grow overflow-auto mt-14 border-2 border-gray-200 border-dashed rounded-lg p-1">
                <router-view></router-view>
            </div>
        </main>
    </div>

</template>

<style scoped>

</style>
