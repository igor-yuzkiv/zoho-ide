<template>
    <div>
        <label
            v-if="label"
            class="block mb-1 ml-1 text-sm font-medium text-gray-900 dark:text-white"
        >
            {{ label }}
        </label>

        <textarea
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            :placeholder="placeholder"
            :rows="rows"
        />
    </div>
</template>

<script>
export default {
    name : "x-textarea",
    emits: ['update:modelValue'],
    props: {
        modelValue : {
            required: true,
        },
        label      : {
            type   : String,
            default: null
        },
        placeholder: {
            type   : String,
            default: null
        },
        rows       : {
            type   : Number,
            default: 4,
        }
    }
}
</script>

<style scoped>

</style>
