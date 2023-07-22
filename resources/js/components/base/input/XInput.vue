<template>
    <div>
        <!--for="name"-->
        <label
            v-if="label"
            class="block mb-1 ml-1 text-md font-medium text-black dark:text-white"
        >
            {{ label }}
        </label>
        <div class="relative">
            <div
                v-if="prependIcon"
                :class="`absolute inset-y-0 left-0 flex items-center pl-2 hover:cursor-pointer ${prependClass}`"
                @click="$emit('click:prepend')"
            >
                <Icon :icon="prependIcon"  class="text-gray-500 black:text-gray-100"></Icon>
            </div>

            <input
                :type="type"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                :class="getInputClasses"
                :placeholder="placeholder"
                :readonly="readonly"
            />

            <div
                v-if="appendIcon"
                :class="`absolute inset-y-0 right-0 flex items-center pr-2 hover:cursor-pointer ${appendClass}`"
                @click="$emit('click:append')"
            >
                <Icon :icon="appendIcon" class="text-gray-500 dark:text-gray-100"/>
            </div>
        </div>
    </div>
</template>

<script>
import {Icon} from "@iconify/vue";

export default {
    name    : "x-input",
    components: {Icon},
    emits   : ['update:modelValue', 'click:prepend', 'click:append'],
    props   : {
        modelValue : {},
        type       : {
            type   : String,
            default: "text"
        },
        label      : {
            type   : String,
            default: null
        },
        placeholder: {
            type   : String,
            default: null
        },
        prependIcon : {
            type   : String,
            default: ''
        },
        prependClass: {
            type   : String,
            default: ''
        },
        appendIcon : {
            type   : String,
            default: ''
        },
        appendClass: {
            type   : String,
            default: ''
        },
        readonly   : {
            type   : Boolean,
            default: false
        }
    },
    computed: {
        getInputClasses() {
            let classes = "block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";

            if (this.prependIcon) {
                classes += ' pl-10';
            }

            if (this.appendIcon) {
                classes += ' pr-10';
            }

            if (this.readonly) {
                classes += ' bg-gray-200 dark:bg-slate-800 dark:border-gray-600 focus:ring-gray-500 focus:border-gray-500 ';
            } else {
                classes += ' bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 ';
            }

            return classes;
        }
    },

}
</script>

<style scoped>

</style>
