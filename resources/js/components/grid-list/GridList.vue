<script>
import {defineComponent, h} from 'vue';

export default defineComponent({
    props: {
        cols: {
            type   : String,
            default: '2'
        }
    },
    setup(props, {slots}) {
        return () => h('div', {
            class: `grid grid-cols-${props.cols} gap-2`
        }, slots)
    }
})
</script>
