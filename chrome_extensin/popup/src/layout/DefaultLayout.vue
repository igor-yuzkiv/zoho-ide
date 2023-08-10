<script setup>
</script>

<template>
    <section class="flex flex-col flex-grow w-[700px] h-[500px] overflow-hidden bg-gray-50 dark:bg-gray-900">
        <main class="flex-1 flex flex-col p-1 overflow-auto">
            <div class="flex flex-col flex-grow">
                <router-view></router-view>
            </div>
        </main>
    </section>
</template>

<style scoped>

</style>
