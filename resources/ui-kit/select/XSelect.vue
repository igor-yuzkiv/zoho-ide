<script>
import {defineComponent} from "vue"

const uid = () =>
    String(
        Date.now().toString(32) +
        Math.random().toString(16)
    ).replace(/\./g, '')

export default defineComponent({
    emits   : ['update:modelValue'],
    props   : {
        modelValue: {type: String},
        options   : {
            type   : Array,
            default: () => ([])
        },
        label     : {
            type   : String,
            default: "",
        },
        itemValue : {
            type   : String,
            default: null,
        },
        itemTitle : {
            type   : String,
            default: null,
        },
        uniqKey   : {
            type   : String,
            default: "",
        }
    },
    computed: {
        realValue: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        },
    },
    methods : {
        getUniqKey(item) {
            return item[this.uniqKey] || uid();
        },
        getItemValue(item) {
            return item[this.itemValue] || item;
        },
        getItemTitle(item) {
            return item[this.itemTitle] || item;
        },
        onChangeHandle(value) {
            this.$emit('update:modelValue', value)
        }
    }
});
</script>

<template>
    <div class="flex flex-col relative w-full focus-within:text-purple-700">
        <slot>
            <label class="text-sm pb-1 dark:text-gray-300 font-medium">{{ label }}</label>
        </slot>
        <select
            class="w-full mt-1 p-2 border border-gray-500 bg-gray-100 rounded-md text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:ring-1 focus:ring-purple-700 focus:bg-white dark:focus:bg-cool-gray-700 focus:outline-none focus:shadow-outline-purple"
            :value="realValue"
            @input="onChangeHandle($event.target.value)"
        >
            <option
                v-for="item in options"
                :key="getUniqKey(item)"
                v-text="getItemTitle(item)"
                :value="getItemValue(item)"
            />
        </select>
    </div>
</template>
