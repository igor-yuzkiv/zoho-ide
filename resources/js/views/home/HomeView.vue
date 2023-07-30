<script setup>
import {useStore} from "vuex";
import {onBeforeMount, ref} from "vue";
import XSnippetEditor from "@/components/editor/XSnippetEditor.vue";
import {createSnippet} from "@/api/deluge.js";

const store = useStore();

onBeforeMount(() => {
    store.commit('SET_PAGE_TITLE', 'Home')
    store.commit('ui/SET_CONTEXT_MENU_ITEMS', [])
})

const snippet = ref({
    name  : 'New Snippet',
    content  : '',
    arguments: [],
});

function addArgument() {
    snippet.value.arguments.push({
        name: 'name',
        type: 'string',
    })
}

async function saveSnippet() {
    await createSnippet(snippet.value)
        .then(({data}) => data)
        .catch(e => console.log(e));
}
function deleteArgument(item) {
    snippet.value.arguments = snippet.value.arguments.filter(i => i !== item);
}

</script>

<style scoped>
</style>

<template>
    <div class="tw-grid tw-flex-grow tw-grid-cols-6 tw-mt-2 tw-gap-x-2">

        <div class="tw-col-span-2 tw-border-x">
            <div class="tw-flex tw-items-center tw-justify-between tw-border-y tw-p-2">
                <div class="tw-text-xl tw-font-bold">
                    {{ snippet.name }}
                    <q-popup-edit v-model="snippet.name" auto-save v-slot="scope">
                        <q-input v-model="scope.value" dense autofocus counter @keyup.enter="scope.set" />
                    </q-popup-edit>
                </div>
                <div class="tw-flex tw-items-center tw-gap-3">
                    <q-btn label="Save" size="sm" color="blue" @click="saveSnippet" />
                </div>
            </div>

            <div class="tw-mt-2 tw-p-1 tw-space-y-1">
                <div class="tw-flex tw-items-center tw-justify-between">
                    <h2 class="tw-text-lg tw-font-semibold">Arguments</h2>
                    <q-btn label="Add" size="sm" color="blue" @click="addArgument" />
                </div>

                <q-list bordered separator>
                    <q-item
                        clickable v-ripple
                        v-for="item in snippet.arguments"
                        :key="item.name"
                    >
                        <q-item-section>
                            <q-item-label>
                                {{ item.name }}
                                <q-popup-edit v-model="item.name" auto-save v-slot="scope">
                                    <q-input v-model="scope.value" dense autofocus counter @keyup.enter="scope.set" />
                                </q-popup-edit>
                            </q-item-label>
                            <q-item-label caption>
                                {{item.type}}
                                <q-popup-edit v-model="item.type" auto-save v-slot="scope">
                                    <q-input v-model="scope.value" dense autofocus counter @keyup.enter="scope.set" />
                                </q-popup-edit>
                            </q-item-label>
                        </q-item-section>
                        <q-item-section avatar>
                            <q-btn flat dense icon="delete" @click="deleteArgument(item)"/>
                        </q-item-section>
                    </q-item>
                </q-list>
            </div>
        </div>

        <div class="tw-col-span-4">
            <x-snippet-editor v-model="snippet.content" height="100%" :arguments="snippet.arguments" theme="vs"/>
        </div>
    </div>
</template>
