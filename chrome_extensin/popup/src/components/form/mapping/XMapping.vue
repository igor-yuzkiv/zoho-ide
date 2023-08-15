<script setup>
import {computed} from "vue";
import XMappingItem from "@/components/form/mapping/XMappingItem.vue";
import XCard from "@/components/card/XCard.vue";
import XIconButton from "@/components/form/icon-button/XIconButton.vue";

const emit = defineEmits('update:modelValue')
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
    const items = getItems.value.filter(i => i.key !== item.key);
    items.push(item);
    emit('update:modelValue', items);
}

</script>

<template>
    <x-card :title="label" expandable>
        <template #actions>
            <x-icon-button
                icon="ic:baseline-plus"
                @click="handleOnChangeItem({key: 'key', value: 'value'})"
            />
        </template>
        <ul>
            <x-mapping-item
                v-for="item in getItems"
                :item-key="item.key"
                :item-value="item.value"
                :key="item.key"
                @update:model-value="handleOnChangeItem"
            ></x-mapping-item>
        </ul>
    </x-card>
</template>

<style scoped>

</style>
