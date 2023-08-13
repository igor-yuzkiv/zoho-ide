<script>
import {defineComponent} from "vue";
import XDelugeTemplateEditor from "@/components/code-editor/XDelugeTemplateEditor.vue";
import XButton from "@/components/button/XButton.vue";
import XCard from "@/components/card/XCard.vue";
import {ListGroup, ListGroupItem, Modal} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {createSnippet, fetchSnippet, updateSnippet} from "@/api/snippets.js"
import XInput from "@/components/input/XInput.vue";
import ArgumentForm from "@/views/snippet-ide/parts/ArgumentForm.vue";
import XTextarea from "@/components/textarea/XTextarea.vue";
import routesName from "@/constans/routesName.js";
import {mapState} from "vuex";
import XSelect from "@/components/select/XSelect.vue";
import {SNIPPET_TYPES} from "@/constans/snippet.js";
import XCodeEditor from "@/components/code-editor/XCodeEditor.vue";

export default defineComponent({
    components: {
        XCodeEditor,
        XSelect,
        XDelugeTemplateEditor,
        XTextarea,
        ArgumentForm,
        Modal,
        XInput,
        ListGroupItem,
        ListGroup,
        Icon,
        XIconButton,
        XCard,
        XButton
    },
    inject    : ['toast'],
    async beforeMount() {
        if (this.$route.params?.id) {
            this.snippetId = this.$route.params.id;
            await this.loadSnippet(this.$route.params.id);
        }

        this.$nextTick(() => {
            this.isLoaded = true;
        });
    },
    data() {
        return {
            isLoaded         : false,
            showToolbar      : false,
            snippetId        : null,
            snippet          : {
                id                   : null,
                name                 : '',
                type                 : "template",
                description          : '',
                content              : '',
                component_name       : '',
                component_insert_text: '',
                arguments            : [],
            },
            argumentFormModal: {
                isOpen    : false,
                modelValue: {}
            }
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
        isSnippetTypeTemplate() {
            return this.snippet.type === SNIPPET_TYPES.template.name;
        }
    },
    methods : {
        goBack(){
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

        handleOpenArgumentModal(item) {
            this.argumentFormModal.isOpen = true;
            this.argumentFormModal.modelValue = item || {};
        },

        handleCloseArgumentModal() {
            this.argumentFormModal.isOpen = false;
            this.argumentFormModal.modelValue = {};
        },

        handleUpdateArgument(item) {
            const snippetArguments = [...this.snippet.arguments];

            const index = snippetArguments.findIndex(argument => {
                if (item?.id) {
                    return argument.id === item.id
                } else {
                    return argument.name === item?.name
                }
            });

            if (index >= 0) {
                snippetArguments[index] = item;
            } else {
                snippetArguments.push(item);
            }

            this.snippet.arguments = snippetArguments;
            this.handleCloseArgumentModal();
        },

        async handleClickSaveSnippet() {
            const upsertSnippet = async () => {
                return this.snippetId
                    ? updateSnippet(this.snippetId, this.snippet)
                    : createSnippet(this.snippet)
            }

            const response = await upsertSnippet(this.snippetId, this.snippet)
                .then(({data}) => data)
                .catch(({response}) => {
                    this.toast.error(response?.data?.message || 'Something went wrong');
                })

            if (response?.id) {
                this.toast.success('Snippet saved');
                this.snippetId = response.id;
                await this.loadSnippet(response.id);
                await this.$router.push({name: routesName.snippets,})
            }
        },

        handleClickDeleteArgument(item) {
            const snippetArguments = [...this.snippet.arguments];
            const tmp = snippetArguments.find(argument => argument === item);
            tmp['_delete'] = true;
            this.snippet.arguments = snippetArguments;
        }
    },
})

</script>

<template>
    <section class="flex flex-col flex-grow overflow-hidden" v-if="isLoaded">

        <!--Top Toolbar-->
        <div
            class="flex items-center flex-none justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
            <div class="flex items-center gap-x-2">
                <x-icon-button @click="goBack">
                    <Icon icon="simple-line-icons:arrow-left"/>
                </x-icon-button>

                <x-icon-button @click="showToolbar = !showToolbar">
                    <Icon :icon="showToolbar ? 'simple-line-icons:size-actual' : 'simple-line-icons:size-fullscreen'"/>
                </x-icon-button>
            </div>

            <x-button @click="handleClickSaveSnippet">
                Save
            </x-button>
        </div>

        <div class="grid grid-cols-6 gap-2 flex-grow overflow-hidden">
            <!--Left Toolbar-->
            <div v-show="!showToolbar" class="col-span-2 flex flex-col flex-gow gap-2 pr-1 overflow-auto">
                <x-card title="General" expandable>
                    <div class="flex flex-col gap-y-2">
                        <x-input
                            label="Name"
                            v-model="snippet.name"
                        />

                        <x-select
                            label="Type"
                            v-model="snippet.type"
                            :options="getSnippetTypesOptions"
                        />

                        <x-textarea
                            v-model="snippet.description"
                            label="Description"
                        />
                    </div>
                </x-card>

                <x-card title="Component" expandable v-if="isSnippetTypeTemplate">
                    <div class="flex flex-col gap-y-2">
                        <x-input
                            label="Component Name"
                            v-model="snippet.component_name"
                        />

                        <x-textarea
                            v-model="snippet.component_insert_text"
                            label="Component Insert Text"
                        />
                    </div>
                </x-card>

                <x-card title="Arguments" expandable v-if="isSnippetTypeTemplate">
                    <template #actions>
                        <x-icon-button icon="ph:plus" @click="handleOpenArgumentModal(null)"/>
                    </template>

                    <ListGroup class="w-full">
                        <ListGroupItem
                            v-for="item in getSnippetArguments"
                            :key="item.name"
                            class="flex items-center justify-between"
                        >
                            <div class="flex flex-col v-full" @click="handleOpenArgumentModal(item)">
                                <span>{{ item.name }}</span>
                                <span class="text-black">type: {{ item.type }}</span>
                            </div>
                            <x-icon-button icon="ph:x-bold" @click="handleClickDeleteArgument(item)"/>
                        </ListGroupItem>
                    </ListGroup>
                </x-card>
            </div>

            <!--Editor-->
            <div
                class="flex flex-col flex-grow"
                :class="{'col-span-4': !showToolbar,'col-span-6': showToolbar}"
            >
                <x-deluge-template-editor
                    v-if="isSnippetTypeTemplate"
                    class="flex-grow"
                    :class="{'col-span-4': !showToolbar,'col-span-6': showToolbar}"
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

    <teleport to="#x__application">
        <!--Argument form modal-->
        <Modal v-if="argumentFormModal.isOpen" @close="handleCloseArgumentModal">
            <template #header>
                <div class="text-black dark:text-white">
                    {{ argumentFormModal.modelValue.name || 'New Argument' }}
                </div>
            </template>
            <template #body>
                <argument-form :model-value="argumentFormModal.modelValue" @update:modalValue="handleUpdateArgument"/>
            </template>
        </Modal>
    </teleport>
</template>

<style scoped>

</style>
