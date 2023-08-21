<script>
import {defineComponent} from "vue";
import XPanel            from "@ui-kit/panel/XPanel.vue";
import XChip             from "@ui-kit/chip/x-chip.vue";
import {Icon}            from "@iconify/vue";
import {fetchSnippets}   from "@/api/snippets.js";
import {SNIPPET_TYPES}   from "@/constans/snippet.js";

export default defineComponent({
    components: {XChip, XPanel, Icon},
    data() {
        return {
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
    <div class="grid grid-cols-3 gap-2" v-if="snippets.length">
        <x-panel
            v-for="item in snippets"
            :key="item.id"
            :clickable="true"
            @click="handleClickSnippet(item)"
            min-height="150px"
        >
            <template #title>
                <h4 class="text-black dark:text-white font-semibold">{{ item.title }}</h4>
            </template>
            <div class="flex flex-col flex-grow text-sm text-gray-500 mt-1">
                {{ item.description }}
            </div>
            <div class="flex flex-col items-start mb-1">
                <x-chip
                    :variant="SNIPPET_TYPES[item.type]['variant']"
                >
                    {{ item.type }}
                </x-chip>
            </div>
        </x-panel>
    </div>

    <div class="flex flex-col items-center justify-center flex-grow text-center" v-else>
        <Icon icon="formkit:sad" class="text-[100px] text-gray-500"/>
        <h1 class="text-xl text-gray-500">No Snippets Found</h1>
    </div>
</template>

<style scoped>

</style>
