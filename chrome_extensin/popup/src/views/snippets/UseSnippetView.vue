<script>
import {defineComponent} from "vue";
import XButton     from "@/components/button/XButton.vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import {Icon} from "@iconify/vue";
import {fetchSnippet}    from "@/api/snippets.js";
import XArgumentsForm    from "@/components/arguments-form/XArgumentsForm.vue";
import XInput            from "@/components/input/XInput.vue";

export default defineComponent({
    components: {XInput, XArgumentsForm, XButton, XIconButton, Icon},
    data() {
        return {
            isLoaded: false,
            snippetId: null,
            snippet: {
                id: null,
                name: '',
                type: '',
                arguments: [],
            },
            snippetData: {},
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
        <x-input></x-input>
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
