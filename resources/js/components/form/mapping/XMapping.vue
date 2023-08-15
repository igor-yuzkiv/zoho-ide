<script setup>
import {computed} from "vue";
import XMappingItem from "@/components/form/mapping/XMappingItem.vue";
import XCard from "@/components/card/XCard.vue";
import XIconButton from "@/components/form/icon-button/XIconButton.vue";
import {uid} from "uid";

const emit = defineEmits(['update:modelValue'])
const props = defineProps({
    label     : {
        type   : String,
        default: "",
    },
    modelValue: {
        type   : Array,
        default: () => ([])
    }
})

const getItems = computed(() => {
    console.log("getItems", props.modelValue);
    if (props.modelValue?.length) {
        return props.modelValue;
    }
    return [];
})

function handleOnChangeItem(item) {
    const items = [...props.modelValue];
    const index = items.findIndex(i => i.id === item.id);

    if (index >= 0) {
        items[index] = item;
    } else {
        items.push(item);
    }

    emit('update:modelValue', items);
}

function addItem() {
    const item = {
        id   : uid(),
        name : '',
        value: '',
    }

    handleOnChangeItem(item);
}

</script>

<template>
    <x-card :title="label" expandable>
        <template #actions>
            <x-icon-button
                icon="ic:baseline-plus"
                @click="addItem"
            />
        </template>
        <ul>
            <x-mapping-item
                v-for="item in getItems"
                :key="item.key"
                :modelValue="item"
                @update:modelValue="handleOnChangeItem"
            />
        </ul>
    </x-card>
</template>

<style scoped>

</style>
