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
    <!--Heading-->
    <div
        class="x_accordionItem-heading"
        :class="{'border border-purple-600 bg-purple-400/25 dark:bg-purple-500/25 text-purple-800': isActiveTab}"
        @click="selectTabHandler(name)"
    >
        <div class="w-full">
            <slot name="heading">{{ name }}</slot>
        </div>
        <div class="flex items-center gap-x-1">
            <x-icon-button :icon="isActiveTab ? 'tabler:chevron-up' : 'tabler:chevron-down'"/>
        </div>
    </div>

    <!--Content. TODO: transition-->
    <div class="x_accordionItem-content" v-if="isActiveTab">
        <slot></slot>
    </div>
</template>

<style scoped>
.x_accordionItem-heading {
    @apply border-t border-gray-200 dark:border-gray-600
}

.x_accordionItem-heading:first-child {
    @apply rounded-t-md
}

.x_accordionItem-heading {
    @apply flex flex-none items-center justify-between dark:text-white font-medium px-2 py-3 cursor-pointer
}

.x_accordionItem-content {
    @apply flex flex-col flex-grow p-2 bg-gray-100 dark:bg-gray-700;
}
</style>
