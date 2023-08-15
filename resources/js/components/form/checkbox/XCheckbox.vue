<script>
import {defineComponent, h} from "vue"
import {Checkbox} from "flowbite-vue"

/**
 * Wrapper for Flowbite component
 * TODO: write custom select component
 */
export default defineComponent({
    setup() {
        return () => h(Checkbox)
    }
});
</script>
