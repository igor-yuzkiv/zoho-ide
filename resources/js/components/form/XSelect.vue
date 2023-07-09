<template>
    <div>
        <label
            v-if="label"
            class="block mb-1 ml-1 text-sm font-medium text-gray-900 dark:text-white"
        >
            {{ label }}
        </label>
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            @change="$emit('update:modelValue', $event.target.value)"
            :value="modelValue"
        >
            <option
                v-for="item in items"
                :key="item[itemValue]"
                :value="item[itemValue]"
            >
                {{ item[itemText] }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    name : "x-select",
    emits: ['update:modelValue'],
    props: {
        modelValue: {
            required: true,
        },
        items     : {
            type    : Array,
            required: true,
        },
        label     : {
            type   : String,
            default: null
        },
        itemValue     : {
            type    : String,
            required: false,
        },
        itemText      : {
            type    : String,
            required: true,
        },
    }
}
</script>

<style scoped>

</style>
