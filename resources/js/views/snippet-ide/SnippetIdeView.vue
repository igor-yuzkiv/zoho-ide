<script>
import {defineComponent} from "vue";
import XDelugeTemplateEditor from "@/components/code-editor/XDelugeTemplateEditor.vue";
import XButton from "@ui-kit/button/XButton.vue";
import XCard from "@ui-kit/card/XCard.vue";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {createSnippet, fetchSnippet, updateSnippet} from "@/api/snippets.js"
import XInput from "@ui-kit/input/XInput.vue";
import XTextarea from "@ui-kit/textarea/XTextarea.vue";
import routesName from "@/constans/routesName.js";
import {mapState} from "vuex";
import XSelect from "@ui-kit/select/XSelect.vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";
import XCodeEditor from "@/components/code-editor/XCodeEditor.vue";
import ArgumentsList from "@/views/snippet-ide/parts/ArgumentsList.vue";
import XTabs from "@ui-kit/tabs/XTabs.vue";
import XTabItem from "@ui-kit/tabs/XTabItem.vue";
import XSnippetsExplorer from "@/components/snippets-explorer/XSnippetsExplorer.vue";
import {useConfirmDialog} from "@ui-kit/confirm-dialog/useConfirmDialog.js";

export default defineComponent({
    components: {
        XSnippetsExplorer,
        XTabItem,
        XTabs,
        ArgumentsList,
        XCodeEditor,
        XSelect,
        XDelugeTemplateEditor,
        XTextarea,
        XInput,
        Icon,
        XIconButton,
        XCard,
        XButton
    },
    inject    : ['toast'],
    setup() {
        const confirmDialog = useConfirmDialog();
        return {confirmDialog}
    },
    async beforeMount() {
        if (this.$route.params?.id) {
            await this.loadSnippet(this.$route.params.id);
        }

        this.$nextTick(() => {
            this.isLoaded = true;
            this.isShowEditor = true;
        });
    },
    data() {
        return {
            isLoaded         : false,
            isShowEditor     : false,
            minimizeView     : false,
            snippetIsModified: false,
            snippet          : {
                id            : null,
                title         : '',
                type          : "template",
                language      : null,
                description   : '',
                content       : '',
                component_name: '',
                arguments     : [],
            },
            currentTab       : '',
        }
    },
    computed: {
        ...mapState({
            darkTheme: state => state.darkTheme
        }),
        getSnippetArguments() {
            return this.snippet.arguments.filter(argument => !argument?._delete)
        },
        getSnippetTypesOptions() {
            return Object.keys(SNIPPET_TYPES).map(key => ({name: key, value: key}))
        },
        isTemplate() {
            return this.snippet.type === SNIPPET_TYPES.template.name;
        }
    },
    watch   : {
        "snippet"      : {
            handler() {
                this.snippetIsModified = true;
            },
            deep: true
        },
        "snippet.title": {
            handler(value) {
                this.snippet.component_name = value.replace(/\W+/g, "-").toLowerCase();
            }
        }
    },
    methods : {
        goBack() {
            this.$router.push({name: routesName.snippets})
        },
        async loadSnippet(id) {
            await fetchSnippet(id, ['arguments'])
                .then(({data}) => {
                    if (data) {
                        this.snippet = data;
                    }
                })
                .catch(e => console.error(e))
        },

        async saveSnippet() {
            const upsertSnippet = async () => {
                return this.snippet?.id
                    ? updateSnippet(this.snippet.id, this.snippet)
                    : createSnippet(this.snippet)
            }

            return await upsertSnippet(this.snippet.id, this.snippet)
                .then(({data}) => data)
                .catch(({response}) => {
                    this.toast.error(response?.data?.message || 'Something went wrong');
                })
        },

        async handleClickSaveSnippet() {
            const response = await this.saveSnippet();
            if (response?.id) {
                this.toast.success('Snippet saved');
                this.snippet.id = response.id;
                await this.loadSnippet(response.id);
                await this.$router.push({name: routesName.snippets,})
            }
        },

        async handleSnippetChange(item) {
            if (this.snippetIsModified) {
                const isConfirmed = await this.confirmDialog.open('Save current snippet?');
                if (isConfirmed) {
                    if (!await this.saveSnippet()) {
                        return;
                    }
                }
            }
            this.isShowEditor = false;
            await this.loadSnippet(item.id);
            this.$nextTick(() => {
                this.$router.replace({name: routesName.snippet_ide, params: {id: item.id}});
                this.snippetIsModified = false;
                this.isShowEditor = true;
            });
        }
    },
})

</script>

<template>
    <section class="flex flex-col flex-grow overflow-hidden" v-if="isLoaded">
        <div
            class="flex items-center flex-none justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div class="flex items-center gap-x-2">
                <x-icon-button @click="goBack">
                    <Icon icon="simple-line-icons:arrow-left"/>
                </x-icon-button>

                <x-icon-button @click="minimizeView = !minimizeView">
                    <Icon :icon="minimizeView ? 'simple-line-icons:size-actual' : 'simple-line-icons:size-fullscreen'"/>
                </x-icon-button>
            </div>

            <div class="flex items-center gap-x-2">
                <x-button @click="handleClickSaveSnippet">
                    Save
                </x-button>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-2 flex-grow overflow-hidden">
            <div v-show="!minimizeView" class="col-span-2 flex flex-col flex-gow gap-2 pr-1 overflow-auto">
                <x-tabs vertical>
                    <x-tab-item
                        name="Options"
                        class="p-1"
                        icon="clarity:cog-line"
                    >
                        <x-card title="Options" expandable>
                            <div class="flex flex-col gap-y-2">
                                <x-input
                                    label="Name"
                                    v-model="snippet.title"
                                />

                                <x-input
                                    v-if="isTemplate"
                                    label="Component Name"
                                    v-model="snippet.component_name"
                                />

                                <x-select
                                    label="Type"
                                    v-model="snippet.type"
                                    :options="getSnippetTypesOptions"
                                    item-value="value"
                                    item-title="name"
                                />

                                <x-textarea
                                    v-model="snippet.description"
                                    label="Description"
                                />
                            </div>
                        </x-card>
                    </x-tab-item>
                    <x-tab-item
                        name="Arguments"
                        class="p-1"
                        v-if="isTemplate"
                        icon="carbon:parameter"
                    >
                        <arguments-list v-model="snippet.arguments"/>
                    </x-tab-item>

                    <x-tab-item name="Snippets" icon="ph:folders">
                        <x-snippets-explorer
                            class="ml-2"
                            :current-id="snippet.id"
                            @item:click="handleSnippetChange"
                        />
                    </x-tab-item>
                </x-tabs>

            </div>

            <!--Editor-->
            <div
                class="flex flex-col flex-grow"
                :class="{'col-span-4': !minimizeView,'col-span-6': minimizeView}"
                v-if="isShowEditor"
            >
                <x-deluge-template-editor
                    v-if="isTemplate"
                    class="flex-grow"
                    :class="{'col-span-4': !minimizeView,'col-span-6': minimizeView}"
                    v-model="snippet.content"
                    :snippet-arguments="getSnippetArguments"
                    :theme="darkTheme ? 'vs-dark' : 'vs'"
                />
                <x-code-editor
                    v-else
                    v-model="snippet.content"
                    class="flex-grow"
                    :theme="darkTheme ? 'vs-dark' : 'vs'"
                />
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
`
