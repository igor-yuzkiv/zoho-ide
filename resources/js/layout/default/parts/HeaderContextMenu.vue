<script setup>
import {computed, ref} from "vue";
import {useStore} from "vuex";

const store = useStore();
const contextMenu = ref(false)
const menuItems = computed(() => store.state.ui.contextMenuItems)

function handleItemClick(item) {
    if (typeof item?.handler === "function") {
        item.handler()
    }
}

</script>

<template>
    <div v-show="menuItems.length">
        <q-btn flat round dense>
            <q-icon name="more_vert"/>
        </q-btn>
        <q-menu v-model="contextMenu">
            <q-list class="tw-min-w-[120px]">
                <template  :key="item.label" v-for="item in menuItems">
                    <q-item
                        clickable v-close-popup v-ripple
                        @click="handleItemClick(item)"
                    >
                        <q-item-section>
                            {{ item.label }}
                        </q-item-section>
                    </q-item>
                </template>
            </q-list>
        </q-menu>
    </div>

</template>

<style scoped>

</style>
