<script>
import XDivider from "@ui-kit/divider/XDivider.vue";

export const XTabsSymbol = Symbol();

import {defineComponent, onMounted, ref, provide} from "vue";
import {Icon} from "@iconify/vue";

export default defineComponent({
    components: {Icon, XDivider},
    emits     : ['update:modelValue'],
    props     : {
        modelValue: {
            type   : String,
            default: null,
        },
        vertical  : {
            type   : Boolean,
            default: false
        },
    },
    setup(props, {slots, emit}) {
        const currentTab = ref(props.modelValue);
        const tabs = slots.default().map(i => ({
            name : i.props.name,
            title: i.props?.title || i.props.name,
            icon: i.props?.icon
        }));

        function handleSelectTab(tabName) {
            currentTab.value = tabName;
            emit('update:modelValue', currentTab.value);
        }

        onMounted(() => {
            if (!props.modelValue && tabs.length > 0) {
                currentTab.value = tabs[0].name;
                handleSelectTab(currentTab.value);
            }
        });

        provide(XTabsSymbol, {currentTab});
        return {tabs, currentTab, handleSelectTab}
    }
})
</script>

<template>
    <div
        class="flex flex-grow w-full overflow-hidden"
        :class="{
            'flex-row': vertical,
            'flex-col': !vertical
        }"
    >
        <ul class="x_nav-list" :class="{
            'x_nav-list-vertical': vertical,
            'x_nav-list-horizontal': !vertical
        }">
            <template
                v-for="item in tabs"
                :key="item.name"
            >
                <li
                    class="x_nav-list-item"
                    :class="{
                        'underline dark:!text-white !text-black': currentTab === item.name,
                    }"
                    @click="handleSelectTab(item.name)"
                >
                    <div class="flex items-center gap-x-1">
                        <Icon  :icon="item.icon" v-if="item.icon" class="text-xl"/>
                        <span :class="{'rotate-180': vertical}">{{ item.title }}</span>
                    </div>
                </li>
                <x-divider/>
            </template>
        </ul>

        <div class="flex flex-col flex-grow">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>
.x_nav-list {
    @apply flex overflow-auto p-2 font-medium border-r border-gray-300 dark:border-gray-800;
}

.x_nav-list-horizontal {
    @apply flex-row gap-x-3;
}

.x_nav-list-vertical {
    @apply flex-col gap-y-3;
}

.x_nav-list-item {
    @apply cursor-pointer text-gray-500 dark:hover:text-white hover:text-black;
}

.x_nav-list-vertical .x_nav-list-item {
    padding: 5px 0;
    writing-mode: vertical-rl;
}
</style>
