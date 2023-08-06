<script>
import {defineComponent, h} from "vue"
import {Textarea} from "flowbite-vue"

/**
 * Wrapper for Flowbite Input component
 */
export default defineComponent({
    setup() {
        return () => h(Textarea)
    }
});
</script>
