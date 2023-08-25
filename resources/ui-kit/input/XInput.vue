<script setup>
defineEmits(["update:modelValue"]);

defineProps({
    modelValue:  {},
    label:       {
        type:    String,
        default: '',
    },
    type:        {
        type:    String,
        default: 'text',
    },
    placeholder: {
        type:    String,
        default: '',
    },
    ariaLabel:   {
        type:    String,
        default: '',
    },
})
</script>

<template>
    <div class="flex flex-col relative w-auto focus-within:text-purple-700">
        <slot>
            <label class="text-sm pb-1 dark:text-gray-300 font-medium">{{ label }}</label>
        </slot>
        <input
            class="w-auto mt-1 p-2 border border-gray-500 bg-gray-100 rounded-md text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:ring-1 focus:ring-purple-700 focus:bg-white dark:focus:bg-cool-gray-700 focus:outline-none focus:shadow-outline-purple"
            :type="type"
            :placeholder="placeholder"
            :aria-label="ariaLabel"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>

<style scoped>

</style>
