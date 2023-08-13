<script setup>
import {ARGUMENT_TYPES} from "@/constans/snippet.js"
import XInput from "@/components/input/XInput.vue";
import {onMounted, ref} from "vue";
import XButton from "@/components/button/XButton.vue";
import XSelect from "@/components/select/XSelect.vue";
import XCheckbox from "@/components/checkbox/XCheckbox.vue";

const defaultFormValue = () => ({
    name    : '',
    type    : ARGUMENT_TYPES.string.name,
    default : null,
    required: false,
    is_slot: false,
})

const emit = defineEmits(['update:modalValue']);
const props = defineProps({
    modelValue: {
        type    : Object,
        required: true,
    }
})

const form = ref(defaultFormValue());

function updateModalValue() {
    emit(
        'update:modalValue',
        Object.assign({}, props.modelValue, form.value)
    );
}

onMounted(() => {
    form.value = Object.assign({}, defaultFormValue(), props.modelValue);
})
</script>

<template>
    <div class="grid gap-y-2">
        <x-input
            label="Name"
            v-model="form.name"
        />

        <x-select
            label="Type"
            :options="Object.values(ARGUMENT_TYPES)"
            v-model="form.type"
        />

        <x-input
            label="Default"
            v-model="form.default"
        />

        <x-checkbox label="Required" v-model="form.required"/>
        <x-checkbox label="Is slot" v-model="form.is_slot"/>
    </div>

    <div class="flex items-center justify-end mt-3">
        <x-button @click="updateModalValue">
            Save
        </x-button>
    </div>
</template>
