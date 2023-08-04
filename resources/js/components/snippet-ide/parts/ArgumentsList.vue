<script setup>
import {ref} from "vue";
import XCard from "@/components/card/XCard.vue";
import {ListGroup, ListGroupItem, Modal} from "flowbite-vue";
import XIconButton from "@/components/icon-button/XIconButton.vue";
import ArgumentForm from "@/components/snippet-ide/parts/ArgumentForm.vue";

defineEmits(['update:modelValue']);
defineProps({
    modelValue: {
        type   : Array,
        default: () => []
    }
});


const argumentFormModal = ref({
    show  : false,
    id    : null,
    isEdit: false,
})

function openArgumentFormModal(item) {
    console.log("openArgumentFormModal", item)
    if (item?.id) {
        argumentFormModal.value.id = item.id;
        argumentFormModal.value.isEdit = item.id;
    }
    argumentFormModal.value.show = true;
}

function closeArgumentFormModal() {
    argumentFormModal.value = {
        show  : false,
        id    : null,
        isEdit: false,
    };
}

function deleteArgument(item) {
    console.log("deleteArgument", item);
    //TODO: ...
    //emit('update:modelValue', props.modelValue.filter(i => i.name !== item.name));
}

</script>

<template>
    <x-card title="Argument" expandable>
        <template #actions>
            <x-icon-button icon="ph:plus" @click="openArgumentFormModal"/>
        </template>

        <ListGroup class="w-full">
            <ListGroupItem
                v-for="item in modelValue"
                :key="item.name"
                class="flex items-center justify-between"
                @click="openArgumentFormModal(item)"
            >
                <div class="flex flex-col v-full">
                    <span>{{ item.name }}</span>
                    <span class="text-black">type: {{ item.type }}</span>
                </div>
                <x-icon-button icon="ph:x-bold" @click="deleteArgument(item)"/>
            </ListGroupItem>
        </ListGroup>
    </x-card>

    <Modal v-if="argumentFormModal.show" @close="closeArgumentFormModal">
        <template #header>Argument Form</template>
        <template #body>
            <argument-form
                :is-edit="argumentFormModal.isEdit"
                :argument-id="argumentFormModal.id"
            ></argument-form>
        </template>
    </Modal>
</template>

<style scoped>

</style>
