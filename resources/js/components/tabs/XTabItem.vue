<script>
import {defineComponent, inject} from "vue";
import {XTabsSymbol} from "@/components/tabs/XTabs.vue";

export default defineComponent({
    props: {
        name : {
            type    : String,
            required: true
        },
        title: {
            type: String,
        },
    },
    setup() {
        const {currentTab} = inject(XTabsSymbol);
        return {currentTab};
    }
})
</script>

<template>
    <div class="flex flex-col flex-grow" v-show="currentTab === name">
       <slot></slot>
    </div>
</template>

<style scoped>

</style>
