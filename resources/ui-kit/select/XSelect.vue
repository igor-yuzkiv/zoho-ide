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
    <label class="block mt-4 text-sm">
        <slot name="label">
            <span class="text-gray-700 dark:text-gray-400"> {{ label }}</span>
        </slot>
        <select
            class="block w-full mt-1 rounded-md text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
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
    </label>
</template>
