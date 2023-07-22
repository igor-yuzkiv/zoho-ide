<script setup>
import {ref} from "vue";
import {dataCenters} from "@/constans/zoho.js"
import ZohoScopes from "@/components/zoho/scopes/ZohoScopes.vue";

const defaultForm = () => ({
    client_id    : '',
    client_secret: '',
    data_center  : dataCenters.us,
    scopes       :[
        "ZohoCRM.bulk.ALL",
        "ZohoCRM.coql.READ",
        "ZohoCRM.modules.ALL",
        "ZohoCRM.settings.ALL",
        "ZohoCRM.settings.fields.ALL",
        "ZohoCRM.settings.layouts.ALL",
        "ZohoCRM.settings.modules.ALL",
        "ZohoCRM.settings.profiles.ALL",
        "ZohoCRM.settings.custom_views.ALL",
        "ZohoCRM.users.ALL",
        "ZohoCreator.bulk.CREATE",
        "ZohoCreator.bulk.READ",
        "ZohoCreator.dashboard.READ",
        "ZohoCreator.meta.application.READ",
        "ZohoCreator.meta.form.READ",
        "ZohoCreator.report.DELETE",
        "ZohoCreator.report.UPDATE",
        "ZohoCreator.report.READ",
        "ZohoCreator.report.CREATE",
        "ZohoCreator.form.CREATE"
    ],
})

const form = ref(defaultForm())

function createConnectionHandle() {
    console.log(form.value);
}

</script>

<template>
    <q-card>
        <q-card-section>
            <div>
                <div class="tw-mt-2">
                    <q-input
                        label="Client ID"
                        outlined
                        v-model="form.client_id"
                    />
                </div>
                <div class="tw-mt-2">
                    <q-input
                        label="Client Secret"
                        outlined
                        type="password"
                        v-model="form.client_secret"
                    />
                </div>
                <div class="tw-mt-2">
                    <q-select
                        outlined
                        v-model="form.data_center"
                        :options="Object.values(dataCenters)"
                        label="Data Center"
                        :option-label="i => `${i.title} (${i.domain})`"
                        option-value="domain"
                    />
                </div>

                <div class="tw-mt-3">
                     <zoho-scopes v-model="form.scopes"></zoho-scopes>
                </div>

            </div>
        </q-card-section>
        <q-separator/>
        <q-card-actions class="justify-between">
            <slot name="actions">
                <q-btn> Cancel</q-btn>
                <q-btn color="blue" @click="createConnectionHandle">Submit</q-btn>
            </slot>
        </q-card-actions>
    </q-card>
</template>

<style scoped>

</style>
