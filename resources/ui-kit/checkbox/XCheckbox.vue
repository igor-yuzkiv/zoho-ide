<script>
import {defineComponent} from "vue"

export default defineComponent({
    emits: ["update:modelValue"],
    props: {
        modelValue: {
            type   : Boolean,
            default: false,
        },
        label     : {
            type   : String,
            default: "",
        },
    }
});
</script>

<template>
    <label class="flex items-center dark:text-gray-400">
        <input
            :checked="modelValue"
            @change="$emit('update:modelValue', $event.target.checked)"
            type="checkbox"
            class="text-purple-600 form-checkbox focus:border-purple-400 rounded-sm focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        />
        <slot name="label">
            <span class="ml-2">{{ label }}</span>
        </slot>
    </label>
</template>
