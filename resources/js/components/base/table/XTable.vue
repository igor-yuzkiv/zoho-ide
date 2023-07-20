<script setup>
import {defineProps, defineEmits} from "vue";
import {v4 as uuid} from "uuid";

const props = defineProps({
    headers: {
        type: Object,
        required: true,
    },
    items: {
        type: Array,
        required: true
    },
    dataKey: {
        type: String,
        default: 'id'
    },
})

defineEmits(['row:click']);


const getRowKey = (row, suffix = '') => {
    let key = (row[props.dataKey])
        ? row[props.dataKey]
        : uuid();

    return (suffix) ? key + `_${suffix}` : key;
}
</script>

<template>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-base text-black uppercase bg-gigas-500 text-white">
            <tr>
                <th
                    scope="col" class="px-6 py-3"
                    v-for="hItem in headers"
                    :key="hItem.value"
                >
                    {{ hItem.name }}
                </th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
            </thead>
            <tbody>
            <tr
                class="bg-white border-b text-black hover:bg-gray-200 cursor-pointer text-base"
                v-for="row in items" :key="getRowKey(row)"
            >
                <td
                    class="px-6 py-4"
                    v-for="cell in headers"
                    :key="getRowKey(row, cell.value)"
                    @click="$emit('row:click', row)"
                >
                    <slot :name="`cell:${cell.value}`" :row="row">
                        {{ row[cell.value] }}
                    </slot>
                </td>
                <td>
                    <slot name="actions" :row="row"></slot>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
