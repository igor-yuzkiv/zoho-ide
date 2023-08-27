<script>
import {defineComponent} from 'vue'
import XCrudForm from "@ui-kit/crud-form/XCrudForm.vue";
import XButton from "@ui-kit/button/XButton.vue";

export default defineComponent({
    components: {XButton, XCrudForm},
    data() {
        return {
            formModel: {},
            formFields: [
                {
                    type: "string",
                    name: "name",
                },
                {
                    type: "number",
                    name: "age",
                },
                {
                    type: "text",
                    name: "description",
                },
                {
                    type: "bool",
                    name: "is_active",
                },
            ],
        }
    },
    methods: {
        test() {
            console.log(this.formModel)
        }
    }
})
</script>

<template>
    <x-crud-form :fields="formFields" v-model="formModel">

        <template #footer>
            <x-button @click="test">Test</x-button>
        </template>
    </x-crud-form>
</template>

<style scoped>

</style>
