<script>
import {defineComponent} from 'vue'
import {createProject, fetchProject, fetchProjectFormMeta, updateProject} from "@/api/projects.js";
import XCrudForm from "@ui-kit/crud-form/XCrudForm.vue";
import XButton from "@ui-kit/button/XButton.vue";


export default defineComponent({
    components: {XButton, XCrudForm},
    emits     : ['project:created', 'project:updated', 'project:createdOrUpdated'],
    inject    : ['toast'],
    props     : {
        projectId: {
            type   : String,
            default: null
        }
    },
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
            if (!this.projectId) return;

            await fetchProject(this.projectId)
                .then(({data}) => {
                    this.project = data;
                })
                .catch(e => console.log(e))
        },
        async loadProjectFormMeta() {
            await fetchProjectFormMeta(this.projectId)
                .then(({data}) => {
                    const {fields} = data;
                    if (Array.isArray(fields)) {
                        this.formFields = fields;
                    }
                })
                .catch(e => console.log(e))
        },

        submitFormHandle() {
            const upsertProject = () => {
                if (this.projectId) {
                    return updateProject(this.projectId, this.project);
                }
                return createProject(this.project);
            }

            upsertProject(this.project)
                .then(({data}) => {
                    this.$emit('project:created', data);
                    this.$emit('project:createdOrUpdated', data);
                })
                .catch(error => {
                    if (!error?.response) {
                        this.toast.error("Something went wrong")
                        return;
                    }
                    const {data} = error.response;
                    this.toast.error(data.message ?? "Something went wrong")
                })
        }
    }
})
</script>

<template>
    <div v-if="isLoaded">
        <x-crud-form :fields="formFields" v-model="project"/>
        <div class="flex items-center">
            <x-button class="block w-full text-center mt-3" @click="submitFormHandle">
                Save
            </x-button>
        </div>
    </div>
</template>

<style scoped>

</style>
