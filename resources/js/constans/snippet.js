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
        variant: "success",
        icon: "bxs:component",
        color: "#046c4e",
    },
    sample: {
        name: "sample",
        variant: "info",
        icon: "ph:file-code",
        color: "#1a56db",
    }
}
