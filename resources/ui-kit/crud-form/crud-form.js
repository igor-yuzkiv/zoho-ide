import XInput from "@ui-kit/input/XInput.vue";
import XTextarea from "@ui-kit/textarea/XTextarea.vue";
import XSwitch from "@ui-kit/switch/XSwitch.vue";

export const fieldSettings = {
    string: {
        component: XInput,
        props    : {
            type: 'text'
        },
        defaultValue: '',
    },
    number: {
        component: XInput,
        props    : {
            type: 'number'
        },
        defaultValue: '',
    },
    text  : {
        component: XTextarea,
        props    : {},
        defaultValue: '',
    },
    bool  : {
        component: XSwitch,
        props    : {},
        defaultValue: false,
    }
};
