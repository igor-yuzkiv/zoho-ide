<template>
    <div class="dark">
        <div class="flex flex-grow w-auto min-w-[400px] h-full min-h-screen overflow-hidden bg-gray-50 dark:bg-gray-900">
            <x-tabs-navigation
                vertical
                :items="items"
                @click:item="clickNavItemHandle"
            />
            <main class="flex-1 flex flex-col p-1 overflow-auto">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script setup>
import XTabsNavigation from "@ui-kit/tabs/XTabsNavigation.vue";

const items = [
    {
        name: 'home',
        title: 'Home',
        icon: 'majesticons:home-line',
    },
    {
        name: 'snippets',
        title: 'Snippets',
        icon: 'ph:folders',
    },
    {
        name: 'settings',
        title: 'Settings',
        icon: 'clarity:cog-line',
    }
];

function clickNavItemHandle(item) {
    console.log(item);
}

</script>
