<script setup>
import {Input, Select} from "flowbite-vue";
import {ARGUMENT_TYPES} from "@/constans/deluge.js";
import {onMounted,ref} from "vue";
import XButton from "@/components/button/XButton.vue";
import {fetchArgumentById} from "@/api/deluge.js";

const props = defineProps({
    isEdit    : {
        type   : Boolean,
        default: false
    },
    argumentId: {
        type   : String,
        default: ""
    }
})

const model = ref({
    name: "",
    type: "",
})

onMounted(async () => {
    if (props.isEdit) {
        const response = await fetchArgumentById(props.argumentId)
            .then(({data}) => data)
            .catch(e => console.error(e))

        if (response) {
            model.value = Object.assign({}, model.value, response)
        }
    }
})

</script>

<template>
    <div>
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
    </div>
    <div>
        <x-button>
            {{ isEdit ? "Update" : "Add" }}
        </x-button>
    </div>
</template>

<style scoped>

</style>
