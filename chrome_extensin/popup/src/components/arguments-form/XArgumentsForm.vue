<script>
import {defineComponent, h} from "vue";
import XInput               from "@/components/input/XInput.vue";
import {ARGUMENT_TYPES}     from "@/constans/snippet.js";

export default defineComponent({
    emits: ["update:modelValue"],
    props: {
        modelValue: {
            type:    Object,
            default: () => {
            },
        },
        argumentsMeta:  {
            type:    Array,
            default: () => []
        },
        fields: [],
    },
    mounted() {
        for (const argument of this.argumentsMeta){
            const type = ARGUMENT_TYPES[argument.type];
            if (!type || !type?.input?.component) {
                continue;
            }


        }
    },
    computed: {
        getComponents() {

        }
    }
});
</script>

<template>

</template>
