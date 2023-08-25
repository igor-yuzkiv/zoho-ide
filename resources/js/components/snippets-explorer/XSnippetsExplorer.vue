<script>
import {defineComponent} from "vue";
import {fetchSnippets} from "@/api/snippets.js";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";

export default defineComponent({
    components: {Icon, XIconButton},
    emits: ["item:click"],
    props     : {
        items    : {
            type   : Array,
            default: () => []
        },
        currentId: {
            type   : String,
            default: null
        }
    },
    data() {
        return {
            snippets  : [],
            pagination: {
                count       : 0,
                current_page: 1,
                per_page    : 10,
                total       : 0,
                total_pages : 1,
            }
        }
    },
    mounted() {
        if (!this.items?.length) {
            this.loadSnippets();
        }
    },
    computed: {
        realItems() {
            return this.items.length ? this.items : this.snippets;
        },
        SNIPPET_TYPES() {
            return SNIPPET_TYPES;
        }
    },
    methods : {
        async loadSnippets() {
            const {data, meta} = await fetchSnippets()
                .then(({data}) => data)
                .catch(e => {
                    console.log(e)
                    return {}
                });

            if (!Array.isArray(data) || !meta?.pagination) {
                return;
            }
            this.snippets = data;
            this.pagination = meta.pagination;
        },
    }
})


</script>

<template>
    <div class="flex flex-col p-1">
        <ul class="space-y-1">
            <li
                v-for="item in realItems"
                :key="item.id"
                class="cursor-pointer rounded-lg shadow-xs"
                :class="{
                    'bg-purple-200  dark:bg-purple-800 hover:dark:bg-purple-700 hover:bg-purple-100': item.id === currentId,
                    'bg-white dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-700': item.id !== currentId
                }"
                @click="$emit('item:click', item)"
            >
                <div class="flex px-1 py-2 items-center justify-between">
                    <div class="flex items-center gap-x-1 dark:text-white truncate">
                        <Icon
                            class="text-lg"
                            :icon="SNIPPET_TYPES[item.type]['icon']"
                            :style="{color: SNIPPET_TYPES[item.type]['color']}"
                        />
                        <div>{{ item.title }}</div>
                    </div>
                    <div>
                        <x-icon-button icon="pepicons-pop:dots-y"></x-icon-button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>

</style>
