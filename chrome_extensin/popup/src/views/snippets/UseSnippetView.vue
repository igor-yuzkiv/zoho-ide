<script>
import {defineComponent} from "vue";
import XButton     from "@/components/button/XButton.vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {fetchSnippet}    from "@/api/snippets.js";
import XArgumentsForm    from "@/components/arguments-form/XArgumentsForm.vue";

export default defineComponent({
    components: {XArgumentsForm, XButton, XIconButton, Icon},
    data() {
        return {
            snippetId: null,
            snippet: {
                id: null,
                name: '',
                type: '',
                arguments: [],
            },
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
    },
    methods: {
        async loadSnippet() {
            const response = await fetchSnippet(this.snippetId, ['arguments']);
            if (response) {
                this.snippet = response;
            }
        },
        handleClickInsert() {

        }
    }
})
</script>

<template>
    <!--Top Toolbar-->
    <div class="flex items-center justify-between mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <x-icon-button @click="$router.go(-1)">
            <Icon icon="simple-line-icons:arrow-left"/>
        </x-icon-button>

        <h1 class="text-black dark:text-white font-semibold text-lg">{{snippet.name}}</h1>

        <x-button @click="handleClickInsert">
            Insert
        </x-button>
    </div>

    <div class="flex flex-col flex-grow mt-2">
        <x-arguments-form :arguments="snippet.arguments"/>
    </div>

</template>

<style scoped>

</style>
