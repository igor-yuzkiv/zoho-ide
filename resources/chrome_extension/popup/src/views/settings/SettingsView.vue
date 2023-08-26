<script setup>
import XAccordion from "@ui-kit/accordion/XAccordion.vue";
import XAccordionItem from "@ui-kit/accordion/XAccordionItem.vue";
import XSelect from "@ui-kit/select/XSelect.vue";
import XSwitch from "@ui-kit/switch/XSwitch.vue";
import XButton from "@ui-kit/button/XButton.vue";
import {THEMES} from "@/constans/appearances.js";
import {computed} from "vue";
import {useStore} from "vuex";
import {dispatchEvent, EVENT_TYPES} from "@/utils/chromeApi.js";
import {Icon} from "@iconify/vue";

const store = useStore();

const currentTheme = computed({
    get() {
        return store.state.settings.theme
    },
    set(value) {
        store.commit("settings/SET_THEME", value)
    }
})

const showLeftPanel = computed({
    get() {
        return store.state.settings.showLeftPanel
    },
    set(value) {
        store.commit("settings/SET_SHOW_LEFT_PANEL", value)
    }
})

function applySettings() {
    dispatchEvent(EVENT_TYPES.setAppearancesSettings, {
        theme        : currentTheme.value,
        showLeftPanel: showLeftPanel.value
    });
}

</script>

<template>
    <x-accordion full-height>
        <x-accordion-item name="Appearances">
            <div class="flex items-center justify-end py-2">
                <x-button
                    class="w-full text-center"
                    @click="applySettings"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m9.55 18l-5.7-5.7l1.425-1.425L9.55 15.15l9.175-9.175L20.15 7.4L9.55 18Z"/></svg>
                    Apply
                </x-button>
            </div>

            <div class="flex flex-col gap-y-2 mt-2">
                <x-select
                    label="Theme"
                    :options="Object.values(THEMES)"
                    item-value="value"
                    item-title="name"
                    v-model="currentTheme"
                />

                <x-switch v-model="showLeftPanel">Show Left Panel</x-switch>
            </div>
        </x-accordion-item>

        <x-accordion-item name="General">
            <div class="dark:text-white">
                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                    a galley of type and scrambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum.</p>
            </div>
        </x-accordion-item>
    </x-accordion>
</template>

<style scoped>

</style>
