<script>
import {defineComponent} from 'vue'
import {fetchProject, fetchProjectFormMeta} from "@/api/projects.js";
import XCrudForm from "@ui-kit/crud-form/XCrudForm.vue";


export default defineComponent({
    components: {XCrudForm},
    data() {
        return {
            isLoaded  : false,
            formFields: [],
            project   : {},
        }
    },
    async mounted() {
        await Promise.all([
            this.loadProject(),
            this.loadProjectFormMeta()
        ])

        this.$nextTick(() => {
            this.isLoaded = true
        })
    },
    methods: {
        async loadProject() {
            if (!this.$route.params?.id) return;

            await fetchProject(this.$route.params.id)
                .then(({data}) => {
                    this.project = data;
                })
                .catch(e => console.log(e))
        },
        async loadProjectFormMeta() {
            await fetchProjectFormMeta(this.$route.params?.id)
                .then(({data}) => {
                    const {fields} = data;
                    if (Array.isArray(fields)) {
                        this.formFields = fields;
                    }
                })
                .catch(e => console.log(e))
        },

        submitFormHandle(e) {
            console.log({
                e, p: this.project
            })
        }
    }
})
</script>

<template>
    <div v-if="isLoaded">
        <x-crud-form :fields="formFields" v-model="project" @submit="submitFormHandle($event)"/>
    </div>
</template>

<style scoped>

</style>
