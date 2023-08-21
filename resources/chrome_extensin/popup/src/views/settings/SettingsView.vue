<script setup>
import XAccordion from "@ui-kit/accordion/XAccordion.vue";
import XAccordionItem from "@ui-kit/accordion/XAccordionItem.vue";
import XIconButton from "@ui-kit/icon-button/XIconButton.vue";
</script>

<template>
    <x-accordion full-height>
        <x-accordion-item name="Deluge Appearances">
            <x-icon-button title="Save" class="text-lg" icon="material-symbols:save"/>
            <div class="dark:text-white">
                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </x-accordion-item>

        <x-accordion-item name="General">
            <div class="dark:text-white">
                <p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </x-accordion-item>
    </x-accordion>
</template>

<style scoped>

</style>
