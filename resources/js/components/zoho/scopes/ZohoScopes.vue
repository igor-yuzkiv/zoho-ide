<script setup>
import {zohoScopes} from "@/constans/zoho.js";
import {Icon} from "@iconify/vue";
import {computed, ref} from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    modelValue: {
        type   : Array,
        default: () => [],
    }
})


const scopeGroups = ref(zohoScopes);
const expendAllGroups = ref(false);
const expendedGroups = ref([]);
const searchKeyword = ref('');

const getFilteredScopes = computed(() => {
    const result = [];

    for (const item of scopeGroups.value) {
        const entries = item.entries.filter(entry => {
            return entry.display_name.toLowerCase().includes(searchKeyword.value.toLowerCase())
        })

        if (entries.length > 0) {
            result.push({
                ...item,
                entries,
            })
        }
    }

    return result;
})

function selectItemHandle(item) {
    const scope = item?.value;
    if (props.modelValue.includes(scope)) {
        emit("update:modelValue", props.modelValue.filter(s => s !== scope))
    } else {
        emit("update:modelValue", [...props.modelValue, scope])
    }
}

function toggleGroupHandle(name) {
    if (expendAllGroups.value) {
        return;
    }

    if (expendedGroups.value.includes(name)) {
        expendedGroups.value = expendedGroups.value.filter(n => n !== name)
    } else {
        expendedGroups.value = [...expendedGroups.value, name]
    }
}

function expendAllHandle() {
    if (expendAllGroups.value) {
        expendedGroups.value = scopeGroups.value.map(i => i.group_name);
    }else {
        expendedGroups.value = [];
    }
}

</script>

<template>
    <div class="tw-flex tw-items-center tw-gap-5">
        <div class="tw-w-full">
            <q-input
                label="Scopes"
                hint="Search..."
                v-model="searchKeyword"
            ></q-input>
        </div>
        <q-checkbox
            v-model="expendAllGroups"
            class="tw-whitespace-nowrap"
            @update:modelValue="expendAllHandle"
        >
            Expend All
        </q-checkbox>
    </div>
    <q-list>
        <q-scroll-area class="tw-h-[45vh]">
            <template
                v-for="group in getFilteredScopes"
                :key="group.group_name"
            >
                <q-item>
                    <q-item-section>
                        <div
                            class="flex items-center tw-gap-2 tw-tex-lg tw-font-semibold tw-cursor-pointer"
                            @click="toggleGroupHandle(group.group_name)"
                        >
                            <Icon icon="fluent:chevron-right-12-filled"></Icon>
                            <div>{{ group.group_name }}</div>
                        </div>

                        <div
                            class="tw-ml-2 tw-mt-2"
                            v-if="group?.entries"
                            v-show="expendedGroups.includes(group.group_name)"
                        >
                            <q-list :padding="false">
                                <q-item
                                    v-for="item in group.entries"
                                    :key="`${group.group_name}_${item.value}`"
                                >
                                    <q-checkbox
                                        :model-value="modelValue.includes(item.value)"
                                        @update:modelValue="selectItemHandle(item)"
                                        :label="item.display_name"
                                    />
                                </q-item>
                            </q-list>
                        </div>
                    </q-item-section>
                </q-item>
            </template>
        </q-scroll-area>
    </q-list>
</template>

<style scoped>

</style>
