<script setup>
import {fieldSettings} from "@ui-kit/crud-form/crud-form.js"
import {nextTick, onMounted, ref} from "vue";

const emit = defineEmits(["update:modelValue"]);
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

const formModel = ref({});

function fieldInputHandle(fieldName, value) {
    formModel.value[fieldName] = value;
    nextTick(() => {
        emit('update:modelValue', formModel.value);
    })
}

function initFormValue() {
    if (!props.fields?.length) {
        return;
    }

    formModel.value = props.fields
        .reduce((acc, field) => {
            acc[field.name] = props.modelValue[field.name] ?? fieldSettings[field.type].defaultValue
            return acc;
        }, {});

    nextTick(() => {
        emit('update:modelValue', formModel.value);
    })
}

onMounted(initFormValue)
</script>

<template>
    <div class="flex flex-col gap-y-2">
        <div
            v-for="field in fields"
            :key="field.name"
        >
            <component
                :is="fieldSettings[field.type].component"
                :model-value="formModel[field.name]"
                @update:modelValue="fieldInputHandle(field.name, $event)"
                :name="field.name"
                :label="field.label ?? field.name"
                v-bind="fieldSettings[field.type].prop"
            ></component>
        </div>
    </div>
</template>

<style scoped>

</style>
