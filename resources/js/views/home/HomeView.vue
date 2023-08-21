<script>
import {defineComponent} from 'vue'
import XSimpleTable from "@ui-kit/simple-table/XSimpleTable.vue";
import {fetchSnippets} from "@/api/snippets.js";
import XChip from "@ui-kit/chip/x-chip.vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";

export default defineComponent({
    computed  : {
        SNIPPET_TYPES() {
            return SNIPPET_TYPES
        }
    },
    components: {XChip, XSimpleTable},
    data() {
        return {
            header: [
                {
                    title: 'Title',
                    itemKey  : 'title',
                },
                {
                    title: 'Type',
                    itemKey  : 'type',
                },
                {
                    title: 'Language',
                    itemKey  : 'language',
                },
            ],
            items: [],
        }
    },
    async mounted() {
        const {data} = await fetchSnippets().then(({data}) => data)
        this.items = data;
    },
    methods: {}
})
</script>

<template>
    <x-simple-table :items="items" :header="header">
        <template #cell:title="{item}">
            <div class="truncate">
                <div class="truncate">{{item.title}}</div>
                <div v-if="item?.description" class="text-gray-500 text-sm">
                    {{item.description}}
                </div>
            </div>
        </template>
        <template #cell:type="{item}">
            <x-chip :variant="SNIPPET_TYPES[item.type]['variant']">{{ item.type }}</x-chip>
        </template>
    </x-simple-table>
</template>

<style scoped>

</style>
