<script>
import {defineComponent} from "vue";
import {fetchProjects} from "@/api/projects.js";
import XTile from "@ui-kit/tile/XTile.vue";
import {Icon} from "@iconify/vue";
import XButton from "@ui-kit/button/XButton.vue";
import XModal from "@ui-kit/modal/XModal.vue";
import ProjectForm from "@/views/projects/parts/ProjectForm.vue";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";

export default defineComponent({
    components: {XIconButton, ProjectForm, XModal, XButton, Icon, XTile},
    data() {
        return {
            isLoaded  : false,
            projects  : [],
            pagination: {
                count       : 0,
                current_page: 1,
                per_page    : 10,
                total       : 0,
                total_pages : 1,
            },
            formModal : {
                isOpen   : false,
                projectId: null,
            }
        }
    },
    mounted() {
        this.loadProjects()

        this.$nextTick(() => {
            this.isLoaded = true
        })
    },
    methods: {
        loadProjects() {
            fetchProjects()
                .then((response) => {
                    const {data, meta} = response.data;
                    if (!data?.length) return;

                    this.projects = data;
                    this.pagination = meta.pagination;
                })
                .catch(e => console.log(e))
        },

        openProjectModal(item) {
            this.formModal = {
                isOpen   : true,
                projectId: item?.id || null,
            };
        },

        closeProjectModal() {
            this.formModal = {
                isOpen   : false,
                projectId: null,
            };
        },

        projectCreatedOrUpdated() {
            this.closeProjectModal();
            this.loadProjects();
        }
    }
})
</script>

<template>
    <div class="flex flex-col flex-grow overflow-auto">
        <div class="flex items-center justify-end mb-2 p-2 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <x-button @click="openProjectModal">
                Create New
            </x-button>
        </div>

        <div class="grid grid-cols-4 xl:grid-cols-6 gap-2" v-if="projects?.length">
            <x-tile
                v-for="project in projects"
                :key="project.id"
                :title="project.name"
            >
                <div class="text-gray-500">
                    {{ project.description }}
                </div>

                <template #actions>
                    <div class="flex items-center justify-end w-full">
                        <x-icon-button icon="material-symbols:edit-sharp" @click="openProjectModal(project)"/>
                    </div>
                </template>
            </x-tile>
        </div>

        <div class="flex items-center justify-center flex-grow" v-else>
            <Icon icon="formkit:sad" class="text-[100px] text-gray-500"/>
        </div>
    </div>

    <XModal
        v-model="formModal.isOpen"
        :title="formModal.projectId ? 'Edit Project' : 'Create Project'"
        @close="closeProjectModal"
    >
        <ProjectForm
            :project-id="formModal.projectId"
            @project:created-or-updated="projectCreatedOrUpdated"
        />
    </XModal>
</template>

<style scoped>

</style>
