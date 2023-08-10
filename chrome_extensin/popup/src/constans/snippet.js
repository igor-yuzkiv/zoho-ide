import XInput from "@/components/input/XInput.vue";

export const ARGUMENT_TYPES = {
    string:  {
        name:  'string',
        value: 'string',
        input: {
            component: XInput,
            props:     {
                type: "text",
            }
        }
    },
    number:  {
        name:  'number',
        value: 'number',
        input: {
            component: XInput,
            props:     {
                type: "number",
            }
        }
    },
    boolean: {
        name:  'boolean',
        value: 'boolean',
    },
    any:     {
        name:  'any',
        value: 'any',
    },
}

export const SNIPPET_TYPES = {
    template: {
        name:     "template",
        variant:  "success",
        language: "php"
    },
    sample:   {
        name:     "sample",
        variant:  "info",
        language: 'typescript'
    }
}
