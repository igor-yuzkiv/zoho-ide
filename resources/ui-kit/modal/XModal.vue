<script>
import {defineComponent} from "vue"
import {Icon} from "@iconify/vue";


export default defineComponent({
    components: {Icon},
    emits     : ["update:modelValue", "close"],
    props     : {
        modelValue: {
            type   : Boolean,
            default: false
        },
        title     : {
            type   : String,
            default: ""
        },
        persistent: {
            type   : Boolean,
            default: false
        },
        dialogClass: {
            type   : Object,
            default: () => {}
        }
    },
    methods   : {
        closeModal() {
            if (this.persistent) return;
            this.$emit("update:modelValue", false)
            this.$emit("close")
        }
    }
})
</script>

<template>
    <transition name="fade">
        <div
            class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-40 overflow-hidden bg-black bg-opacity-60 flex flex-col items-center justify-center"
            v-if="modelValue"
        >
            <div
                class="w-auto px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4"
                :class="dialogClass"
                role="dialog"
            >
                <header class="flex justify-between">
                    <div>
                        <slot name="header">
                            <h4 class="text-black dark:text-white font-semibold text-xl">{{ title }}</h4>
                        </slot>
                    </div>
                    <button
                        v-if="!persistent"
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                        aria-label="close"
                        @click="closeModal"
                    >
                        <Icon icon="ep:close-bold"></Icon>
                    </button>
                </header>

                <div class="mt-4 mb-3 px-2">
                    <slot></slot>
                </div>

                <footer
                    v-if="$slots.footer"
                    class="flex flex-col items-center justify-between px-4 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                >
                    <slot name="footer"></slot>
                </footer>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 200ms ease-out;
}
</style>
