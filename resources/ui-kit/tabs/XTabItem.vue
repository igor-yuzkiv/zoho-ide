<script>
import {defineComponent, h, inject} from "vue";
import {XTabsSymbol} from "./XTabs.vue";

export default defineComponent({
    props: {
        name : {
            type    : String,
            required: true
        },
        title: {
            type: String,
        },
        icon : {
            type   : String,
            default: null,
        },
    },
    setup(props, {slots}) {
        const {currentTab} = inject(XTabsSymbol);

        return () => h('div', {
            class: 'flex flex-col flex-grow',
            style: {
                display: currentTab.value === props.name ? 'block' : 'none'
            }
        }, slots)
    }
})
</script>
