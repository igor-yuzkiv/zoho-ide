<script>
    //if props items not provided, then fetch from api
    import {defineComponent} from "vue";
    import {fetchSnippets} from "@/api/snippets.js";

    export default defineComponent({
        props: {
            items: {
                type: Array,
                default: () => []
            }
        },
        data() {
            return {
                snippets: [],
            }
        },
        computed: {
            getSnippets() {
                return this.items.length ? this.items : this.snippets;
            }
        },
        mounted() {
            if (!this.items.length) {
                fetchSnippets()
                    .then(({data}) => {
                        this.snippets = data;
                    })
                    .catch(e => console.error(e))
            }
        },
        methods: {

        }
    });
</script>

<template>

</template>

<style scoped>

</style>
