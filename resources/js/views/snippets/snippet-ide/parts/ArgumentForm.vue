<script setup>
import {ARGUMENT_TYPES} from "@/constans/snippet.js"
import XInput from "@/components/form/input/XInput.vue";
import {computed, onMounted, ref} from "vue";
import XButton from "@/components/form/button/XButton.vue";
import XSelect from "@/components/form/select/XSelect.vue";
import XCheckbox from "@/components/form/checkbox/XCheckbox.vue";
import XTextarea from "@/components/form/textarea/XTextarea.vue";

const defaultFormValue = () => ({
    name       : '',
    type       : ARGUMENT_TYPES.string.name,
    default    : null,
    is_required: false,
    is_slot    : false,
    description: '',
})

const emit = defineEmits(['update:modalValue']);
const props = defineProps({
    modelValue: {
        type       : Object,
        is_required: true,
    }
})

const form = ref(defaultFormValue());

const defaultValueField = computed(() => {
    const type = ARGUMENT_TYPES[form.value.type] || ARGUMENT_TYPES.string;
    return {
        component: type.input.component,
        props    : {
            label: 'Default Value',
            ...type.input.props,
        },
    }
})

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

        <x-textarea
            label="Description"
            v-model="form.description"
        />

        <div class="grid grid-cols-2 my-1">
            <x-checkbox label="Is Required" v-model="form.is_required"/>
            <x-checkbox label="Is Slot" v-model="form.is_slot"/>
        </div>

        <div class="flex flex-col overflow-hidden max-h-[300px] pt-2 border-t border-gray-500">
            <component
                class="overflow-y-auto"
                :is="defaultValueField.component"
                v-bind="defaultValueField.props"
                v-model="form.default"
            />
        </div>
    </div>

    <div class="flex items-center justify-end mt-3">
        <x-button @click="updateModalValue">
            Save
        </x-button>
    </div>
</template>
