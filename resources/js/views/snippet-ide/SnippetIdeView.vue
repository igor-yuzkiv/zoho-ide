<script>
import {defineComponent} from "vue";
import XCodeEditor from "@/components/code-editor/XCodeEditor.vue";
import XButton from "@/components/base/button/XButton.vue";
import XCard from "@/components/base/card/XCard.vue";
import {ListGroup, ListGroupItem, Modal} from "flowbite-vue";
import XIconButton from "@/components/base/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {createSnippet, fetchSnippet, updateSnippet} from "@/api/deluge.js"
import XInput from "@/components/base/input/XInput.vue";
import ArgumentForm from "@/components/argument-form/ArgumentForm.vue";
import XTextarea from "@/components/base/textarea/XTextarea.vue";
import routesName from "@/constans/routesName.js";
import {mapState} from "vuex";
export default defineComponent({
    components: {
        XTextarea,
        ArgumentForm,
        Modal,
        XInput,
        ListGroupItem,
        ListGroup,
        Icon,
        XIconButton,
        XCard,
        XButton,
        XCodeEditor
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
                id         : null,
                name       : '',
                content    : '',
                description: '',
                arguments  : []
            },
            argumentFormModal: {
                isOpen    : false,
                modelValue: {}
            }
        }
    },
    computed: {
        ...mapState(['darkTheme']),
        getSnippetArguments() {
            return this.snippet.arguments.filter(argument => !argument?._delete)
        }
    },
    methods : {
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
            const index = snippetArguments.findIndex(argument => argument.name === item?.name);
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
                if (this.snippetId) {
                    return updateSnippet(this.snippetId, this.snippet)
                } else {
                    return createSnippet(this.snippet)
                }
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
    <div class="flex items-center justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <x-icon-button @click="showToolbar = !showToolbar">
            <Icon :icon="showToolbar ? 'simple-line-icons:size-fullscreen' : 'simple-line-icons:size-actual'"/>
        </x-icon-button>

        <x-button @click="handleClickSaveSnippet">
            Save
        </x-button>
    </div>

    <div class="grid grid-cols-6 gap-2 flex-grow overflow-hidden" v-if="isLoaded">
        <div v-show="!showToolbar" class="col-span-2 flex flex-col flex-gow gap-2 pr-1 overflow-auto">
            <x-card title="General" expandable>
                <div class="flex flex-col gap-y-2">
                    <x-input label="Name" v-model="snippet.name"/>
                    <x-textarea v-model="snippet.description" label="Description"/>
                </div>
            </x-card>

            <x-card title="Arguments" expandable>
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

        <x-code-editor
            :class="{
                'col-span-4': !showToolbar,
                'col-span-6': showToolbar,
            }"
            :variables="getSnippetArguments"
            :theme="darkTheme ? 'vs-dark' : 'vs'"
            v-model="snippet.content"
        />
    </div>

    <teleport to="body">
        <Modal v-if="argumentFormModal.isOpen" @close="handleCloseArgumentModal">
            <template #header>
                {{ argumentFormModal.modelValue.name || 'New Argument' }}
            </template>
            <template #body>
                <argument-form :model-value="argumentFormModal.modelValue" @update:modalValue="handleUpdateArgument"/>
            </template>
        </Modal>
    </teleport>
</template>

<style scoped>

</style>
