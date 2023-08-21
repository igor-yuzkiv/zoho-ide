<script>
import {defineComponent, inject} from "vue";
import {XAccordionSymbol} from "@ui-kit/accordion/XAccordion.vue";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";

export default defineComponent({
    components: {XIconButton},
    props     : {
        name: {
            type    : String,
            required: true,
        }
    },
    setup() {
        const {currentTab, selectTabHandler} = inject(XAccordionSymbol);
        return {currentTab, selectTabHandler};
    },
    computed: {
        isActiveTab() {
            return this.name === this.currentTab;
        }
    }
});
</script>

<template>
    <div
        class="x_accordionItem"
        :class="{'x_accordionItem-active': isActiveTab}"
        role="listitem"
    >
        <!--Heading-->
        <div @click="selectTabHandler(name)">
            <slot name="heading">
                <div
                    class="x_accordionItem-heading"
                    :class="{'border border-purple-600 bg-purple-400/25 dark:bg-purple-500/25 text-purple-800': isActiveTab}"
                >
                    <span>{{ name }}</span>
                    <x-icon-button :icon="isActiveTab ? 'tabler:chevron-up' : 'tabler:chevron-down'"/>
                </div>
            </slot>
        </div>
        <!--Content-->
        <div class="x_accordionItem-content" v-if="isActiveTab">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>

.x_accordionItem {
    @apply flex flex-col border-t border-gray-200 dark:border-gray-600
}

.x_accordionItem:first-child {
    @apply rounded-t-md
}

.x_accordionItem:first-child .x_accordionItem-heading {
    @apply rounded-t-md
}

.x_accordionItem-heading {
    @apply flex items-center justify-between dark:text-white font-medium px-2 py-3 cursor-pointer
}

.x_accordionItem-content {
    @apply p-2 bg-gray-100 dark:bg-gray-700;
}
</style>
