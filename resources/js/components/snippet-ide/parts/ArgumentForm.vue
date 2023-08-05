<script setup>
import {Checkbox, Input, Select} from "flowbite-vue";
import {ARGUMENT_TYPES} from "@/constans/deluge.js";
import {computed, inject, onMounted, ref} from "vue";
import XButton from "@/components/button/XButton.vue";
import {createSnippetArgument, updateSnippetArgument} from "@/api/deluge.js";

const toast = inject('toast');

const props = defineProps({
    isEdit    : {
        type   : Boolean,
        default: false
    },
    snippetId : {
        type   : String,
        default: ""
    },
    argumentId: {
        type   : String,
        default: null
    }
})

const model = ref({
    name    : "",
    type    : "string",
    default : null,
    required: false,
})

async function submitForm() {
    console.log(model);

    function upsertArgument() {
        return props.isEdit
            ? updateSnippetArgument(props.snippetId, model.value)
            : createSnippetArgument(props.snippetId, model.value);
    }

    const response = await upsertArgument()
        .then(({data}) => data)
        .catch(({response}) => {
            console.error(response);
            toast.error(response.data.message);
        })


    console.log(response);
}


onMounted(async () => {
    if (props.isEdit) {
        /* const response = await fetchArgumentById(props.argumentId)
             .then(({data}) => data)
             .catch(e => console.error(e))

         if (response) {
             model.value = Object.assign({}, model.value, response)
         }*/
    }
})
</script>

<template>
    <div class="grid gap-2">
        <Input
            label="Name"
            v-model="model.name"
        />

        <Select
            label="Type"
            v-model="model.type"
            :options="Object.values(ARGUMENT_TYPES)"
            @input="$emit('update:type', $event.target.value)"
        />

        <Input
            label="Default Value"
            v-model="model.default"
            :placeholder="`${!model?.default ? 'null' : ''}`"
        />

        <Checkbox
            label="Required"
            v-model="model.required"
        />
    </div>
    <div class="flex items-center justify-between mt-2">
        <x-button @click="submitForm">
            {{ isEdit ? "Update" : "Add" }}
        </x-button>
    </div>
</template>

<style scoped>

</style>
