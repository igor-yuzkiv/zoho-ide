<script>
import {defineComponent} from "vue";
import XButton from "@ui-kit/button/XButton.vue";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {
    fetchSnippet,
    renderSnippet
} from "@/api/snippets.js";
import XArgumentsForm from "@/views/snippets/use/parts/XArgumentsForm.vue";
import {
    dispatchEvent,
    EVENT_TYPES
} from "@/utils/chromeApi.js";

export default defineComponent({
    components: {XArgumentsForm, XButton, XIconButton, Icon},
    data() {
        return {
            isLoaded   : false,
            snippetId  : null,
            snippet    : {
                id       : null,
                name     : '',
                type     : '',
                arguments: [],
            },
            snippetData: {},
        }
    },
    watch: {
        snippetData: {
            handler: function () {
                console.log("snippetData", this.snippetData);
            },
            deep   : true,
            immediate: true
        }
    },
    async mounted() {
        const {id} = this.$route.params;
        if (!id) {
            this.$router.push({name: "home"});
            return;
        }

        this.snippetId = id;
        await this.loadSnippet();

        this.$nextTick(() => {
            this.isLoaded = true;
        })
    },
    methods: {
        async loadSnippet() {
            const response = await fetchSnippet(this.snippetId, ['arguments']);
            if (response) {
                this.snippet = response;
            }
        },
        async handleClickInsert() {
            console.log(this.snippetData);
            const response = await renderSnippet(this.snippet.id, this.snippetData)
                .catch(e => {
                    console.log(e);
                })

            if (!response?.code) {
                alert(response?.message || "something went wrong")
                return;
            }

            await dispatchEvent(EVENT_TYPES.injectCode, response);
        },
        async goBack() {
            this.$router.go(-1);
        },
    }
})
</script>

<template>
    <!--Top Toolbar-->
    <div class="flex items-center justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <x-icon-button @click="goBack">
            <Icon icon="simple-line-icons:arrow-left"/>
        </x-icon-button>

        <h1 class="text-black dark:text-white font-semibold text-lg">{{ snippet.name }}</h1>

        <x-button @click="handleClickInsert">
            Insert
        </x-button>
    </div>

    <div class="flex flex-col flex-grow mt-2" v-if="isLoaded">
        <x-arguments-form :argumentsMeta="snippet.arguments" v-model="snippetData"/>
    </div>

</template>

<style scoped>

</style>
