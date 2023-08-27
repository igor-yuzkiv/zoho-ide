<script>
import {defineComponent} from "vue";
import {fetchSnippets} from "@/api/snippets.js";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import ListItem from "@/components/snippets-explorer/parts/ListItem.vue";
import GridItem from "@/components/snippets-explorer/parts/GridItem.vue";
import XMenu from "@ui-kit/menu/XMenu.vue";
import XMenuItem from "@ui-kit/menu/XMenuItem.vue";

export default defineComponent({
    components: {XMenuItem, XMenu, Icon, XIconButton},
    emits     : ["item:click", "item:delete"],
    props     : {
        items    : {
            type   : Array,
            default: () => []
        },
        currentId: {
            type   : String,
            default: null
        },
        view     : {
            type     : String,
            default  : "list",
            validator: (value) => ["list", "grid"].includes(value)
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
        getItemComponent() {
            return this.view === "list" ? ListItem : GridItem
        },
        realItems() {
            return this.items.length ? this.items : this.snippets;
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
    <div
        :role="view === 'list' ? 'listbox' : 'grid'"
        :class="{
            'space-y-1': view === 'list',
            'grid grid-cols-4 gap-2': view === 'grid'
        }"
    >
        <component
            v-for="item in realItems"
            :key="item.id"
            :is="getItemComponent"
            :item="item"
            :isActive="item.id === currentId"
            @item:click="$emit('item:click', item)"
            @item:delete="$emit('item:delete', item)"
        >
            <template #actions>
                <x-menu>
                    <x-menu-item @click="$emit('item:delete', item)">
                        <Icon icon="ic:outline-delete"></Icon>
                        Delete
                    </x-menu-item>
                </x-menu>
            </template>
        </component>
    </div>
</template>

<style scoped>

</style>
