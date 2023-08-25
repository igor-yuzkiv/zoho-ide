<script setup>

import * as monaco from "monaco-editor";
import {computed} from "vue";
import {useStore} from "vuex";
import XSearchInput from "@ui-kit/search-input/XSearchInput.vue";
import XThemeSwitch from "@ui-kit/theme-swith/XThemeSwitch.vue";

const store = useStore();


const dark = computed({
    get: () => store.state.darkTheme,
    set: (value) => {
        localStorage.setItem("darkTheme", value);
        store.commit("SET_DARK_THEME", value);
        monaco.editor.setTheme(value ? "vs-dark" : "vs-light");
    }
});

function toggleTheme() {
    console.log("toggleTheme")
    dark.value = !dark.value;
}

</script>

<template>
    <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
        >
            <h1 class="dark:text-white font-semibold font-xl uppercase">Snippets Storage</h1>
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
                <x-search-input></x-search-input>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
                <!-- Theme toggler -->
                <li class="flex">
                    <XThemeSwitch :status="dark"  @click="toggleTheme"/>
                </li>
            </ul>
        </div>
    </header>
</template>

<style scoped>

</style>
