<script setup>
defineEmits(["update:modelValue", "onInput"]);

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
    <div class="flex flex-col relative w-full focus-within:text-purple-500">
        <slot>
            <label class="text-sm pb-1 dark:text-gray-300 font-medium">{{ label }}</label>
        </slot>
        <input
            class="w-full p-2 border border-gray-500 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
            :type="type"
            :placeholder="placeholder"
            :aria-label="ariaLabel"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>

<style scoped>

</style>
