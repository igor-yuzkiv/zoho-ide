<script>
import {defineComponent} from 'vue'
import {Icon} from "@iconify/vue";

export default defineComponent({
    components: {Icon},
    emits     : ["click:item"],
    props     : {
        vertical  : {
            type   : Boolean,
            default: false
        },
        showTitles: {
            type   : Boolean,
            default: false,
        },
        items     : {
            type   : Array,
            default: () => []
        }
    }
})
</script>

<template>
    <ul class="x_tabsNav" :class="{
            'x_tabsNav-vertical': vertical,
            'x_tabsNav-horizontal': !vertical
        }">
        <template v-for="item in items" :key="item.name">
            <li
                class="x_tabsNav-item"
                :class="{'underline dark:!text-white !text-black': currentTab === item.name}"
                @click="$emit('click:item', item)"
                :title="item.title"
            >
                <div class="flex items-center gap-x-1">
                    <Icon :icon="item.icon" v-if="item.icon" class="text-xl"/>
                    <span v-show="showTitles" :class="{'rotate-180': vertical}">{{ item.title }}</span>
                </div>
            </li>
        </template>
    </ul>
</template>

<style scoped>
.x_tabsNav {
    @apply flex overflow-auto p-2 font-medium border-r border-gray-300 dark:border-gray-800;
}

.x_tabsNav-horizontal {
    @apply flex-row gap-x-3;
}

.x_tabsNav-vertical {
    @apply flex-col gap-y-1;
}

.x_tabsNav-item {
    @apply cursor-pointer text-gray-500 dark:hover:text-white hover:text-black;
}

.x_tabsNav-vertical .x_tabsNav-item {
    padding: 5px 0;
    writing-mode: vertical-rl;
}
</style>
