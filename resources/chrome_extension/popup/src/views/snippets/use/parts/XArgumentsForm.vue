<script>
import {defineComponent} from "vue";
import {ARGUMENT_TYPES}  from "@/constans/snippet.js";

export default defineComponent({
    emits: ["update:modelValue"],
    props: {
        modelValue   : {
            type   : Object,
            default: () => {
            },
        },
        argumentsMeta: {
            type   : Array,
            default: () => []
        },
    },
    data() {
        return {
            fields: []
        }
    },
    watch: {
        modelValue: {
            handler: function () {
                this.prepareFields();
            },
            deep   : true,
            immediate: true
        }
    },
    mounted() {
        this.setDefaultValue();
    },
    methods: {
        prepareFields() {
            const fields = [];
            for (const argument of this.argumentsMeta) {
                const {input} = ARGUMENT_TYPES[argument.type];
                if (!input?.component) {
                    continue;
                }

                fields.push({
                    component: input.component,
                    props    : {
                        ...input.props,
                        label: argument.name
                    },
                    id       : argument.id,
                    name     : argument.name,
                    value    : this.modelValue[argument.name],
                })
            }
            this.fields = fields;
        },

        setDefaultValue() {
            const data = {};
            for (const argument of this.argumentsMeta) {
                if (!this.modelValue[argument.name]) {
                    continue;
                }

                data[argument.name] = argument.default;
            }
            this.$emit("update:modelValue", data);
        },

        handleFieldInput(field, value) {
            const data = {...this.modelValue};
            data[field.name] = value;
            this.$emit("update:modelValue", data);
        }
    }
});
</script>

<template>
    <div class="grid grid-cols-1 gap-2">
        <div v-for="field in fields" :key="field.id">
            <component
                :is="field.component"
                v-bind="field.props"
                :modelValue="field.value"
                @update:modelValue="handleFieldInput(field, $event)"
            />
        </div>
    </div>
</template>
