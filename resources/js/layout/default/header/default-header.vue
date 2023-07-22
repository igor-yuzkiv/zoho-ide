<script setup>
    import {useStore} from "vuex";
    import {computed} from "vue";
    import BellNotification from "@/layout/default/header/bell-notification/BellNotification.vue";
    import CurrentUser from "@/layout/default/header/current-user/CurrentUser.vue";

    const store = useStore();
    const title = computed(() => store.state.pageTitle);
</script>

<template>
    <header class="flex items-center justify-between flex-none h-14 bg-white border-b border-gray-100 w-full pl-64 pr-10">
        <div class="pl-2">
            <h1 class="text-xl font-bold text-gray-800">{{ title }}</h1>
        </div>

        <div class="flex items-center gap-6">
            <bell-notification></bell-notification>
            <current-user></current-user>
        </div>
    </header>
</template>

<style scoped>

</style>
