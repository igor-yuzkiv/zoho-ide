<template>
    <q-layout view="hHh lpR fFf">
        <q-header elevated class="bg-primary text-white">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer"/>
                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg" alt="logo">
                    </q-avatar>
                    {{ title }}
                </q-toolbar-title>

                <header-context-menu></header-context-menu>
                <q-btn dense flat round icon="menu" @click="toggleRightDrawer"/>
            </q-toolbar>
        </q-header>

        <q-drawer :mini="leftMiniState" side="left" bordered :model-value="true" class="tw-p-2">
            <q-list>
                <q-item clickable v-ripple :to="{name: routesName.home}">
                    <q-item-section avatar>
                        <Icon class="tw-text-xl tw-text-blue-500" icon="ic:round-home"></Icon>
                    </q-item-section>

                    <q-item-section class="tw-text-lg tw-font-semibold text-black">Home</q-item-section>
                </q-item>

                <q-item  clickable v-ripple :to="{name: routesName.projects}">
                    <q-item-section avatar>
                        <Icon class="tw-text-xl tw-text-blue-500" icon="file-icons:microsoft-project"></Icon>
                    </q-item-section>

                    <q-item-section class="tw-text-lg tw-font-semibold text-black">Projects</q-item-section>
                </q-item>
            </q-list>
        </q-drawer>

        <q-drawer v-model="rightDrawerOpen" side="right" bordered>
            <!-- drawer content -->
        </q-drawer>

        <q-page-container>
            <div class="tw-m-2">
                <router-view/>
            </div>
        </q-page-container>
    </q-layout>
</template>

<script setup>
import {computed, ref} from 'vue'
import {useStore} from "vuex";
import {Icon} from "@iconify/vue";
import routesName from "@/constans/routesName.js";
import HeaderContextMenu from "@/layout/default/parts/HeaderContextMenu.vue";
const store = useStore();

const title = computed(() => store.state.pageTitle)
const leftMiniState = ref(true)
const rightDrawerOpen = ref(false)


function toggleLeftDrawer() {
    leftMiniState.value = !leftMiniState.value
}

function toggleRightDrawer() {
    rightDrawerOpen.value = !rightDrawerOpen.value
}
</script>

<style scoped>

</style>
