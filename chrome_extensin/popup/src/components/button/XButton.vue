<script>
import {defineComponent, h, useSlots} from "vue";

export default defineComponent({
    props: {
        outlined: {
            type   : Boolean,
            default: false,
        },
        variant : {
            type     : String,
            default  : 'default',
            validator: (value) => {
                return ['default', 'purple', 'success', 'warning', 'info'].includes(value);
            }
        }
    },
    setup() {
        const slots = useSlots();
        //TODO: variants, outlined
        return () => h(
            'button', {
                class: "flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple",
            },
            slots
        )
    }
})
</script>
