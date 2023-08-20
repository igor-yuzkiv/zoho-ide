import XInput from "@ui-kit/input/XInput.vue";
import XMapping from "@/components/mapping/XMapping.vue";

export const ARGUMENT_TYPES = {
    string : {
        name : 'string',
        value: 'string',
        input: {
            component: XInput,
            props    : {type: "text"}
        }
    },
    mapping: {
        name     : 'mapping',
        value    : 'mapping',
        input: {
            component: XMapping,
            props    : {}
        }
    }
}

export const SNIPPET_TYPES = {
    template: {
        name: "template",
        variant: "success"
    },
    sample: {
        name: "sample",
        variant: "info"
    }
}
