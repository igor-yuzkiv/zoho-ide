<script setup>
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
import {PROJECTS_ROUTE} from "@/constans/routes.js";
import {useRoute, useRouter} from "vue-router";

const store = useStore();
const router = useRouter();
const route = useRoute();
import {permissions} from "@/constans/zoho_scopes.json";

const {id: projectId} = route.params;
if (!projectId) {
    router.push({name: PROJECTS_ROUTE});
}

const form = ref({
    project_id   : projectId,
    client_id    : '',
    client_secret: '',
    data_center  : '',
    scopes       : [],
})

const groups = computed(() => {
    return permissions.map(i => i.group_name)
})

const selectedGroup = ref(null);
const groupScopes = computed(() => {
    const group = permissions.find(i => i.group_name === selectedGroup.value)
    console.log(group);
    if (Array.isArray(group?.entries)) {
        return group.entries;
    }
    return [];
})

const selectedScopes = ref([]);

function selectScopeHandle(item) {
    if (!item?.value) {
        return;
    }

    if (selectedGroup.value.includes(item.value)) {
        selectedScopes.value = selectedScopes.value.filter(i => i !== item.value);
    } else {
        selectedScopes.value.push(item.value);
    }
}

onMounted(() => {
    store.commit("mutatePageTitle", "New Connection");
});


</script>

<template>
    <div class="grid grid-cols-2 bg-white rounded-xl">
        <div></div>
        <div class="flex">
            <div>
                <div>
                    {{ selectedScopes }}
                </div>
                <div class="flex">
                    <ul class="mt-2">
                        <li
                            class="cursor-pointer py-1 px-2 rounded-xl"
                            :class="{
                                'bg-gray-200': group === selectedGroup,
                            }"
                            v-for="group in groups"
                            :key="group"
                            @click="selectedGroup = group"
                        >
                            {{ group }}
                        </li>
                    </ul>

                    <ul>
                        <li
                            class="cursor-pointer py-1 px-2 rounded-xl"
                            v-for="scope in groupScopes"
                            :key="scope.value"
                            :class="{
                                'bg-gray-100': selectedScopes.includes(scope.value),
                            }"
                            @click="selectScopeHandle(scope)"
                        >
                            {{ scope.display_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
