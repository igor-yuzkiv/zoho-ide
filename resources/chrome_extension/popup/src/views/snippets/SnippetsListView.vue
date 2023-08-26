<script>
import {defineComponent} from "vue";
import XChip             from "@ui-kit/chip/x-chip.vue";
import {Icon}            from "@iconify/vue";
import {fetchSnippets}   from "@/api/snippets.js";
import {SNIPPET_TYPES}   from "@/constans/snippet.js";
import XSimpleTable from "@ui-kit/simple-table/XSimpleTable.vue";

export default defineComponent({
    components: {XSimpleTable, XChip, Icon},
    data() {
        return {
            isLoaded: false,
            header: [
                {
                    title: 'Title',
                    itemKey  : 'title',
                },
                {
                    title: 'Type',
                    itemKey  : 'type',
                },
            ],
            snippets:   [],
            pagination: {
                count:        0,
                current_page: 1,
                per_page:     10,
                total:        0,
                total_pages:  1,
            }
        }
    },
    async mounted() {
        await this.loadSnippets();
        this.$nextTick(() => this.isLoaded = true);
    },
    methods:  {
        async loadSnippets() {
            const {data, meta} = await fetchSnippets()
            if (!Array.isArray(data) || !meta?.pagination) {
                return;
            }

            this.snippets = data;
            this.pagination = meta.pagination;
        },

        handleClickSnippet(item) {
            this.$router.push({
                name:   "snippets.use",
                params: {
                    id: item.id
                }
            })
        },
    },
    computed: {
        SNIPPET_TYPES: () => SNIPPET_TYPES,
    }
})
</script>

<template>
    <div class="flex flex-col flex-grow" v-if="snippets.length">
        <x-simple-table :items="snippets" :header="header" @click:item="handleClickSnippet">
            <template #cell:title="{item}">
                <div class="truncate">{{item.title}}</div>
                <div v-if="item?.description" class="text-gray-500 text-sm">
                    {{item.description}}
                </div>
            </template>
            <template #cell:type="{item}">
                <x-chip :variant="SNIPPET_TYPES[item.type]['variant']">{{ item.type }}</x-chip>
            </template>
        </x-simple-table>
    </div>

    <div class="flex flex-col items-center justify-center flex-grow text-center" v-else v-show="isLoaded">
        <Icon icon="formkit:sad" class="text-[100px] text-gray-500"/>
        <h1 class="text-xl text-gray-500">No Snippets Found</h1>
    </div>
</template>

<style scoped>

</style>
