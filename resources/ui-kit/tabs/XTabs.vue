<script>
import {defineComponent, onMounted, ref, provide} from "vue";
import XTabsNavigation from "@ui-kit/tabs/XTabsNavigation.vue";

export const XTabsSymbol = Symbol();
export default defineComponent({
    components: {XTabsNavigation},
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
        showTitles: {
            type   : Boolean,
            default: false,
        }
    },
    setup(props, {slots, emit}) {
        const currentTab = ref(props.modelValue);
        const tabs = slots.default().map(i => ({
            name : i.props.name,
            title: i.props?.title || i.props.name,
            icon : i.props?.icon,
        }));

        function handleSelectTab({name}) {
            currentTab.value = name;
            emit('update:modelValue', currentTab.value);
        }

        onMounted(() => {
            if (!props.modelValue && tabs.length > 0) {
                currentTab.value = tabs[0].name;
                handleSelectTab({name: currentTab.value});
            }
        });

        function checkIsActive(item) {
            return item.name === currentTab.value;
        }

        provide(XTabsSymbol, {currentTab});
        return {tabs, currentTab, handleSelectTab, checkIsActive}
    }
})
</script>

<template>
    <div
        class="flex flex-grow w-full overflow-hidden"
        :class="{'flex-row': vertical, 'flex-col': !vertical}"
    >
        <x-tabs-navigation
            :vertical="vertical"
            :show-titles="showTitles"
            :items="tabs"
            @click:item="handleSelectTab"
            :check-is-active="checkIsActive"
        />
        <div class="flex flex-col flex-grow">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
