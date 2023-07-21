<script setup>
import {onMounted, ref} from "vue";
import {setPageTitle} from "@/mixins/pageMixin.js";
import {createProject, fetchProject, updateProject} from "@/api/project.js";
import XInput from "@/components/base/input/XInput.vue";
import XButton from "@/components/base/button/XButton.vue";

const emit = defineEmits(['cancel', 'submit']);

const props = defineProps({
    isEdit   : {
        type   : Boolean,
        default: false,
    },
    projectId: {
        type: String,
        default: 0,
    }
})

const defaultForm = () => ({
    id  : 0,
    name: '',
});

const form = ref(defaultForm());

async function fetchData() {
    return await fetchProject(props.projectId)
        .then(({data}) => {
            form.value = data;
            return data;
        })
        .catch(e => console.error(e));
}

function submitFormHandle() {
    if (props.isEdit) {
        updateProject(props.projectId, form.value)
            .then(({data}) => {
                emit('submit', {
                    isEdit  : props.isEdit,
                    data    : form.value,
                    response: data,
                })
            })
            .catch(e => console.error(e));
    } else {
        createProject(form.value)
            .then(({data}) => {
                emit('submit', {
                    isEdit  : props.isEdit,
                    data    : form.value,
                    response: data,
                })
            })
            .catch(e => console.error(e));
    }
}

onMounted(() => {
    if (props.isEdit) {
        fetchData().then(({name}) => {
            setPageTitle(`Edit ${name} Project`);
        });
    } else {
        setPageTitle('Create Project');
    }
})

</script>

<template>
    <div>
        <div>
            <x-input v-model="form.name" label="Project Name"></x-input>
        </div>

        <div class="flex items-center justify-between mt-3">
            <x-button class="px-4" @click="$emit('cancel')">
                Cancel
            </x-button>
            <x-button class="px-4" @click="submitFormHandle">
                Save
            </x-button>
        </div>
    </div>
</template>

<style scoped>

</style>
