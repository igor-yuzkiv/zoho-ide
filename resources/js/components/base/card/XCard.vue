<script setup>
import {defineProps, ref} from "vue";
import {Icon} from "@iconify/vue";
import XButton from "@/components/base/button/XButton.vue";

defineProps({
    name: {
        type   : String,
        default: ''
    }
});

const expanded = ref(true);
const content = ref();


function toggleExpanded() {
    expanded.value = !expanded.value;
}

function enter(element) {
    const height = content.value.clientHeight + 'px';
    element.style.height = 0;

    requestAnimationFrame(() => {
        element.style.height = height;
    });
}

function afterEnter(element) {
    element.style.height = null;
}

function leave(element) {
    element.style.height = content.value.clientHeight + 'px';
    requestAnimationFrame(() => {
        element.style.height = 0;
    });
}

</script>

<template>
    <div class="bg-white border border-blue-400 rounded-xl p-1">
        <div class="flex justify-between items-center">
            <div class="font-bold text-[18px]">{{ name }}</div>
            <div class="flex items-center gap-2">
                <slot name="actions"></slot>
                <div class="x__chevron_container cursor-pointer" @click="toggleExpanded">
                    <div class="x__chevron" :class="{expanded: expanded}">
                        <Icon icon="gg:chevron-down"></Icon>
                    </div>
                </div>
            </div>
        </div>
        <transition
            name="expand"
            @enter="enter"
            @leave="leave"
            @after-enter="afterEnter"
        >
            <div class="x__content" v-show="expanded">
                <div class="pt-4" ref="content">
                    <slot></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.expand-enter-active,
.expand-leave-active {
    overflow: hidden;
}

.x__chevron_container {
    padding: 3px;
    @apply rounded-full border border-blue-400
}

.x__chevron {
    font-size: 22px;
    padding-top: 1px;
    transform: rotateZ(0);
    transition: transform .3s cubic-bezier(0.25, 0.8, 0.5, 1);
    @apply rounded-full bg-blue-400 text-white
}

.x__chevron_container:hover .x__chevron {
    @apply bg-blue-500
}

.x__chevron.expanded {
    transform: rotateZ(180deg);
}

.x__content {
    transition: height .3s cubic-bezier(0.25, 0.8, 0.5, 1);
}
</style>
