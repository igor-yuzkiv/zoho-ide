<script>
import {defineComponent, h} from "vue";

export default defineComponent({
    setup(props, {slots}) {
        return () => h(
            "div",
            {
                class: "flex items-center px-2 gap-x-2 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-700",
                role : "menuitem"
            },
            slots
        )
    }
})
</script>
