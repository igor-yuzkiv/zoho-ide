<script>
import {defineComponent} from "vue";
import {fetchSnippets} from "@/api/deluge.js";
import XTable from "@/components/table/XTable.vue";
import XButton from "@/components/base/button/XButton.vue";
import XIconButton from "@/components/base/icon-button/XIconButton.vue";

export default defineComponent({
    components: {XIconButton, XButton, XTable},
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
    async beforeMount() {
        await this.loadSnippets();
    },
    methods: {
        async loadSnippets(page = 1) {
            const {data, meta} = await fetchSnippets(page, this.pagination.per_page)
                .then(({data}) => data)
                .catch(e => console.error(e))

            if (!data?.length || !meta?.pagination) {
                return;
            }

            this.snippets = data;
            this.pagination = meta.pagination;
        },

        openSnippetIde(snippetId) {
            //TODO:
        },

        handleClickDeleteSnippet(snippetId) {
            //TODO:...
        }
    }
})

</script>

<template>
    <div class="flex items-center justify-end mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <x-button @click="handleClickDeleteSnippet(null)">
            Create New
        </x-button>
    </div>

    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3">
        <div
            v-for="item in snippets"
            :key="item.id"
            class="flex flex-col min-h-[200px] p-2 bg-white dark:bg-gray-800 hover:bg-purple-200 dark:hover:bg-purple-800 rounded-lg shadow-xs cursor-pointer"
        >
            <div
                class="flex flex-col flex-grow text-black dark:text-white"
                @click="openSnippetIde(item.id)"
            >
                <h3 class="text-lg mb-1 font-semibold">{{ item.name }}</h3>
                <div class="text-sm">
                    {{ item.description }}
                </div>
            </div>
            <div class="flex items-center justify-between border-t pt-2">
                <x-icon-button icon="ic:baseline-delete" @click="handleClickDeleteSnippet(item.id)"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
