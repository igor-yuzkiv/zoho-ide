<script>
import {defineComponent, h} from 'vue'

export default defineComponent({
    props: {
        vertical: {
            type   : Boolean,
            default: false
        }
    },
    setup() {
        return (props) => h('div', {
            class:{
                'flex w-auto border-gray-300 dark:border-gray-600': true,
                'border-t': props.vertical,
                'border-r': !props.vertical,
            }

        })
    }
})
</script>
