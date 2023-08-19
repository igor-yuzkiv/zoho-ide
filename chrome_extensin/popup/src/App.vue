<template>
    <div class="dark">
        <div class="flex flex-col flex-grow w-auto min-w-[400px] h-full min-h-screen overflow-hidden bg-gray-50 dark:bg-gray-900">
            <main class="flex-1 flex flex-col p-1 overflow-auto">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script setup>
</script>
