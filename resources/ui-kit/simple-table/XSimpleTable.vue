<script>
import {defineComponent} from 'vue'
import {uid} from "uid";

export default defineComponent({
    emits: ['click:item'],
    props: {
        items    : {
            type   : Array,
            default: () => []
        },
        header   : {
            type   : Array,
            default: () => [
                /*{
                    title: '',
                    itemKey: '',
                }*/
            ]
        },
        uniqueKey: {
            type   : String,
            default: 'id'
        }
    },
    data() {
        return {}
    },
    methods: {
        getRowKey(row) {
            return row[this.uniqueKey] ?? uid();
        }
    }
})
</script>

<template>
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
            <th
                class="px-4 py-3"
                v-for="item of header" :key="item.title"
            >
                {{ item.title }}
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        <tr
            class="text-gray-800 dark:text-gray-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700"
            v-for="row of items" :key="getRowKey(row)"
        >
            <td
                class="p-2 text-sm"
                v-for="item of header" :key="item.title"
                @click="$emit('click:item', row)"
            >
                <slot :name="`cell:${item.itemKey}`" :item="row">
                    {{ row[item.itemKey] }}
                </slot>
            </td>

            <td v-if="$slots.actions" class="px-4 py-3 text-sm">
                <slot name="actions" :row="row"></slot>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
