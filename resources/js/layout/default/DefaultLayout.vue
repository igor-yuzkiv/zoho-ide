<script setup>
import NavSidebar from "@/layout/default/nav-sidebar/NavSidebar.vue";
import DefaultHeader from "@/layout/default/header/default-header.vue";
</script>

<template>
    <div class="flex flex-col max-h-screen h-screen overflow-hidden">
        <nav-sidebar></nav-sidebar>
        <default-header></default-header>

        <main class="flex flex-grow ml-64 px-2 overflow-hidden bg-catskill-100">
            <div class="flex flex-col flex-grow overflow-auto my-2 pr-2">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<style scoped>

</style>
