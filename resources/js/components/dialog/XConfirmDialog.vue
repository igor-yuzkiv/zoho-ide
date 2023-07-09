<template>
    <x-dialog
        :value="isOpen"
        @update="isOpen = $event"
    >
        <template #header>
            <div class="flex items-center gap-1">
                <Icon icon="fxemoji:warningsign"></Icon>
                {{ config?.name }}
            </div>
        </template>

        <template #default>
            <div v-if="config?.subject" class="x__subject">
                {{ config.subject }}
            </div>

            <div class="x__message" v-html="config.message"></div>
        </template>

        <template #actions>
            <div class="flex items-center justify-between">
                <x-button
                    class="bg-white text-gigas-500 px-4"
                    @click="clickCancelHandle"
                >
                    {{ config.cancelButton }}
                </x-button>

                <x-button
                    class="px-4"
                    @click="clickConfirmHandle"
                >
                    {{ config.confirmButton }}
                </x-button>
            </div>
        </template>
    </x-dialog>
</template>

<script setup>
import {computed} from "vue";
import {useStore} from "vuex";
import XButton from "@/components/button/XButton.vue";
import XDialog from "@/components/dialog/XDialog.vue";
import {Icon} from "@iconify/vue";

const store = useStore();

const isOpen = computed({
    get() {
        return store.state.confirmDialog.isOpen
    },
    set(value) {
        if (value) {
            store.commit("confirmDialog/mutateIsOpen", value);
        } else {
            store.commit("confirmDialog/closeDialog");
        }

    }
});
const config = computed(() => store.state.confirmDialog.config);

const clickConfirmHandle = () => {
    store.state.confirmDialog.resolve(true);
    store.commit("confirmDialog/closeDialog")
}

const clickCancelHandle = () => {
    store.state.confirmDialog.resolve(false);
    store.commit("confirmDialog/closeDialog")
}

</script>

<style scoped>
.x__subject {
    @apply text-xl text-black font-semibold text-center mt-10
}

.x__message {
    @apply pt-8 text-center text-base font-normal
}

.x__message {
    color: #1F295A;
}
</style>
