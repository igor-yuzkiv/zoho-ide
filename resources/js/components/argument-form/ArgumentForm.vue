<script setup>
import {ARGUMENT_TYPES} from "@/constans/deluge.js"
import XInput from "@/components/base/input/XInput.vue";
import {Checkbox, Select} from "flowbite-vue"
import {onMounted, ref} from "vue";
import XButton from "@/components/base/button/XButton.vue";

const defaultFormState = () => ({
    name    : '',
    type    : ARGUMENT_TYPES.string.name,
    default : null,
    required: false,
})

const emit = defineEmits(['update:modalValue']);

const props = defineProps({
    modelValue: {
        type    : Object,
        required: true,
    }
})

const form = ref(defaultFormState());

function updateModalValue() {
    emit(
        'update:modalValue',
        Object.assign({}, props.modelValue, form.value)
    );
}

onMounted(() => {
    form.value = Object.assign({}, form.value, props.modelValue);
})
</script>

<template>
    <div class="grid gap-y-2">
        <x-input
            label="Name"
            v-model="form.name"
        />

        <Select
            label="Type"
            :options="Object.values(ARGUMENT_TYPES)"
            v-model="form.type"
        />

        <x-input
            label="Default"
            v-model="form.default"
        />

        <Checkbox label="Required" v-model="form.required"/>
    </div>

    <div class="flex items-center justify-end mt-3">
        <x-button @click="updateModalValue">
            Save
        </x-button>
    </div>
</template>
