<script>
import {defineComponent} from "vue";
import CodeEditor from "@/components/code-editor/CodeEditor.vue";
import XButton from "@/components/button/XButton.vue";
import XCard from "@/components/card/XCard.vue";
import {ListGroup, ListGroupItem, Modal} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {fetchSnippet, updateSnippet} from "@/api/deluge.js"
import XInput from "@/components/input/XInput.vue";
import ArgumentForm from "@/components/argument-form/ArgumentForm.vue";
import XTextarea from "@/components/textarea/XTextarea.vue";

export default defineComponent({
    components: {
        XTextarea,
        ArgumentForm, Modal, XInput, ListGroupItem, ListGroup, Icon, XIconButton, XCard, XButton, CodeEditor
    },
    inject    : ['toast'],
    props     : {
        snippetId: {
            type    : String,
            required: true,
        }
    },
    async beforeMount() {
        await this.loadSnippet();

        this.$nextTick(() => {
            this.isLoaded = true;
        });
    },
    data() {
        return {
            isLoaded         : false,
            showToolbar      : false,
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
        getSnippetArguments() {
            return this.snippet.arguments.filter(argument => !argument?._delete)
        }
    },
    methods : {
        async loadSnippet() {
            await fetchSnippet(this.snippetId, ['arguments'])
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
            if (item?.id) {
                const index = snippetArguments.findIndex(argument => argument.id === item.id);
                if (index >= 0) {
                    snippetArguments[index] = item;
                }
            } else {
                snippetArguments.push(item);
            }

            this.snippet.arguments = snippetArguments;
            this.handleCloseArgumentModal();
        },

        async handleClickSaveSnippet() {
            const response = await updateSnippet(this.snippetId, this.snippet)
                .then(({data}) => data)
                .catch(e => console.error(e))

            if (response) {
                this.toast.success('Snippet saved');
                await this.loadSnippet();
            } else {
                this.toast.error('Something went wrong');
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
        <div
            class="col-span-2 flex flex-col flex-gow gap-2 pr-1 overflow-auto"
            v-show="!showToolbar"
        >
            <x-card title="General" expandable>
                <x-input label="Name" v-model="snippet.name"/>
                <x-textarea v-model="snippet.description" label="Description"/>
            </x-card>

            <x-card title="Arguments" expandable>
                <template #actions>
                    <x-icon-button icon="ph:plus" @click="handleOpenArgumentModal"/>
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

        <code-editor
            :class="{
                'col-span-4': !showToolbar,
                'col-span-6': showToolbar,
            }"
            :variables="getSnippetArguments"
            theme="vs"
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
