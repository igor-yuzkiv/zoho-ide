<script setup>
import {fieldSettings} from "@ui-kit/crud-form/crud-form.js"
import {nextTick, onMounted, reactive} from "vue";
import XButton from "@ui-kit/button/XButton.vue";

const emit = defineEmits(["update:modelValue", "submit"]);
const props = defineProps({
    modelValue: {
        type   : Object,
        default: () => ({})
    },
    fields    : {
        type    : Array,
        required: true
    },
})

const formModel = reactive({});

function fieldInputHandle(fieldName, value) {
    formModel.value[fieldName] = value;
    nextTick(() => {
        emit('update:modelValue', formModel.value);
    })
}

function resetForm() {
    if (!props.fields?.length) {
        return;
    }

    formModel.value = props.fields
        .reduce((acc, field) => {
            acc[field.name] = field['value'] ?? fieldSettings[field.type].defaultValue
            return acc;
        }, {});

    nextTick(() => {
        emit('update:modelValue', formModel.value);
    })
}

onMounted(resetForm)
</script>

<template>
    <div class="flex flex-col gap-y-2">
        <div
            v-for="field in fields"
            :key="field.name"
        >
            <component
                :is="fieldSettings[field.type].component"
                :value="formModel[field.name]"
                @update:modelValue="fieldInputHandle(field.name, $event)"
                :name="field.name"
                :label="field.name"
                v-bind="fieldSettings[field.type].prop"
            ></component>
        </div>

        <slot name="footer" :data="formModel">
            <x-button class="w-full" @click="emit('submit', formModel.value)">Submit</x-button>
        </slot>
    </div>
</template>

<style scoped>

</style>
