<script setup>

import routesName from "@/constans/routesName.js";
</script>

<template>
    <div>
        <div>
            <h1 class="text-md font-semibold text-black">Zoho Creator</h1>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <router-link
                :to="{name: routesName.snippet_view}"
                class="flex items-center justify-center border border-blue-400 rounded-xl hover:bg-blue-50 cursor-pointer p-3 text-center font-medium"
            >
                Sync Crm Module
            </router-link>
        </div>
    </div>

</template>

<style scoped>

</style>