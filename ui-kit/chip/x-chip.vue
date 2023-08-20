<script>
import {defineComponent, h} from "vue";

const commonClasses = "block items-center px-2 rounded-xl";

const variants = {
    default: "bg-gray-700 text-gray-100",
    success: "bg-green-700 text-green-100",
    danger : "bg-red-700 text-red-100",
    warning: "bg-yellow-700 text-yellow-100",
    info   : "bg-blue-700 text-blue-100",
};

export default defineComponent({
    props: {
        variant: {
            type   : String,
            default: 'default',
            validator: (value) => Object.keys(variants).includes(value)
        }
    },
    setup(props, {slots}) {
        return () => h(
            'div',
            {
                class: `${commonClasses} ${variants[props.variant]}`,
            },
            slots
        )
    },
})
</script>
