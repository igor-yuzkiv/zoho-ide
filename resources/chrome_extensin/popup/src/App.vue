<template>
    <section :class="{dark: isDarkTheme}">
        <div id="zohoIde-application"
             class="relative flex flex-col flex-grow w-auto min-w-[400px] h-full min-h-screen overflow-hidden">
            <header class="flex flex-col flex-none z-10 py-2 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
                >
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <x-search-input></x-search-input>
                    </div>
                </div>
            </header>

            <div class="relative flex flex-grow h-full overflow-hidden">
                <x-tabs-navigation
                    vertical
                    :items="navItems"
                    @click:item="clickNavItemHandle"
                    :check-is-active="checkIsActiveItem"
                />
                <main class="flex-1 flex flex-col p-1 overflow-auto">
                    <router-view></router-view>
                </main>
            </div>
        </div>
    </section>
</template>

<script setup>
import XTabsNavigation from "@ui-kit/tabs/XTabsNavigation.vue";
import {useRoute, useRouter} from "vue-router";
import routesName from "@/constans/routesName.js";
import {computed} from "vue";
import XSearchInput from "@ui-kit/search-input/XSearchInput.vue";
import {THEMES} from "@/constans/appearances.js";
import {useStore} from "vuex";

const route = useRoute();
const router = useRouter();
const store = useStore();

const isDarkTheme = computed(() => {
    return store.state.theme === THEMES.dark.value
});

const navItems = [
    {
        name : routesName.home,
        title: 'Home',
        icon : 'majesticons:home-line',
    },
    {
        name : routesName.snippets,
        title: 'Snippets',
        icon : 'ph:folders',
    },
    {
        name : routesName.settings,
        title: 'Settings',
        icon : 'clarity:cog-line',
    }
];

function clickNavItemHandle(item) {
    router.push({name: item.name}).catch(() => {
    });
}

function checkIsActiveItem({name}) {
    return route.name === name;
}
</script>

<style scoped>
#zohoIde-application {
    @apply bg-gray-50 dark:bg-gray-900;
    z-index: 1;
}

#zohoIde-application:before {
    content: ' ';
    display: block;
    z-index: -1;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0.6;
    background-image: url('assets/logo.png');
    background-repeat: no-repeat;
    background-position: center;
}
</style>
