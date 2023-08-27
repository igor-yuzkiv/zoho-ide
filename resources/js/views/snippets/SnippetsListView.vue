<script>
import {defineComponent} from "vue";
import {deleteSnippet, fetchSnippets} from "@/api/snippets.js";
import XButton from "@ui-kit/button/XButton.vue";
import routesName from "@/constans/routesName.js";
import {useConfirmBeforeAction} from "@ui-kit/confirm-dialog/useConfirmDialog.js";
import {Icon} from "@iconify/vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";
import XSnippetsExplorer from "@/components/snippets-explorer/XSnippetsExplorer.vue";
import XSelect from "@ui-kit/select/XSelect.vue";

export default defineComponent({
    components: {XSelect, XSnippetsExplorer, Icon, XButton},
    inject    : ['toast'],
    setup() {
        const confirmBeforeAction = useConfirmBeforeAction();
        return {confirmBeforeAction}
    },
    data() {
        return {
            viewMode  : "grid",
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
    computed: {
        SNIPPET_TYPES() {
            return SNIPPET_TYPES
        },
    },
    methods : {
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
    <div class="flex items-center justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div>
            <x-select :options="['list', 'grid']" v-model="viewMode"></x-select>
        </div>
        <x-button @click="openSnippetIde(null)">
            Create New
        </x-button>
    </div>

    <x-snippets-explorer
        class="overflow-auto"
        v-if="snippets.length"
        :items="snippets"
        @item:click="openSnippetIde($event.id)"
        @item:delete="handleClickDeleteSnippet($event.id)"
        :view="viewMode"
    />

    <div class="flex items-center justify-center flex-grow" v-else>
        <Icon icon="formkit:sad" class="text-[100px] text-gray-500"/>
    </div>
</template>

<style scoped>

</style>
