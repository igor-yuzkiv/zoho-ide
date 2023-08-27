<script setup>
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
import {nextTick, ref} from "vue";
import {useOnClickOutside} from "@ui-kit/hooks/useOnClickOutside.js";

const isOpen = ref(false);
const container = ref(null);
const menuContainer = ref(null);

useOnClickOutside(container, () => isOpen.value = false)

const menuContainerStyle = ref({
    top : 0,
    left: 0,
})

function openHandle(evt) {
    isOpen.value = true;
    nextTick(() => setMenuPosition(evt))
}

function setMenuPosition(evt) {
    let left = evt.pageX || evt.clientX;
    let top = evt.pageY || evt.clientY;

    if (menuContainer?.value) {
        if (menuContainer.value?.offsetWidth) {
            left = left - menuContainer.value?.offsetWidth;
        }

        if (menuContainer.value?.offsetHeight) {
            top = top - menuContainer.value?.offsetHeight;
        }
    }

    menuContainerStyle.value = {
        top : `${top}px`,
        left: `${left}px`,
    }
}
</script>

<template>
    <div ref="container">
        <x-icon-button icon="pepicons-pop:dots-x" @click.stop="openHandle"></x-icon-button>
        <div
            ref="menuContainer"
            class="fixed rounded-xl bg-white dark:bg-gray-700 shadow-lg p-2 z-10 dark:text-white"
            :style="menuContainerStyle"
            :class="{hidden: !isOpen}"
        >
            <div class="flex flex-col" role="listbox">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
