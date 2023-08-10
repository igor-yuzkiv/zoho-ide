<script>
import {defineComponent} from "vue";
import {deleteSnippet, fetchSnippets} from "@/api/snippets.js";
import XButton from "@/components/base/button/XButton.vue";
import XIconButton from "@/components/base/icon-button/XIconButton.vue";
import routesName from "@/constans/routesName.js";
import {useConfirmBeforeAction} from "@/components/confirm-dialog/useConfirmDialog.js";
import {Icon} from "@iconify/vue";
import XChip from "@/components/chip/x-chip.vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";
import XPanel from "@/components/panel/XPanel.vue";

export default defineComponent({
    components: {XPanel, XChip, Icon, XIconButton, XButton},
    inject    : ['toast'],
    setup() {
        const confirmBeforeAction = useConfirmBeforeAction();
        return {confirmBeforeAction}
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
    async beforeMount() {
        await this.loadSnippets();
    },
    computed  : {
        SNIPPET_TYPES() {
            return SNIPPET_TYPES
        }
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
            this.$router.push({
                name  : routesName.snippet_ide,
                params: {
                    id: snippetId
                }
            })

        },

        handleClickDeleteSnippet(snippetId) {
            if (!snippetId) {
                return;
            }

            const deleteHandle = () => {
                deleteSnippet(snippetId)
                    .then(() => {
                        this.snippets = this.snippets.filter(item => item.id !== snippetId);
                        this.toast.success("Snippet deleted successfully")
                    })
                    .catch(e => {
                        console.error(e);
                        this.toast.error("Something went wrong")
                    })
            }

            this.confirmBeforeAction.open(deleteHandle, 'Are you sure you want to delete this snippet?');
        }
    }
})

</script>

<template>
    <div class="flex items-center justify-end mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <x-button @click="openSnippetIde(null)">
            Create New
        </x-button>
    </div>

    <div class="grid grid-cols-4 gap-2" v-if="snippets.length">
        <x-panel
            v-for="item in snippets"
            :key="item.id"
            :title="item.name"
            :clickable="true"
            @click="openSnippetIde(item.id)"
        >
            <template #default>
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
            </template>

            <template #actions>
                <x-icon-button
                    icon="ic:baseline-delete"
                    @click="handleClickDeleteSnippet(item.id)"
                />
            </template>
        </x-panel>
    </div>

    <div class="flex items-center justify-center flex-grow" v-else>
        <Icon icon="formkit:sad" class="text-[100px] text-gray-500"/>
    </div>
</template>

<style scoped>

</style>
