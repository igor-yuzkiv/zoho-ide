<script>
import {defineComponent, h} from "vue"
import {Input} from "flowbite-vue"

/**
 * Wrapper for Flowbite Input component
 */
export default defineComponent({
    setup() {
        return () => h(Input)
    }
});
</script>
