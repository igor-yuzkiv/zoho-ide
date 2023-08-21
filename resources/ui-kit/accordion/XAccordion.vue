<script>
import {defineComponent, h, ref, provide, onMounted} from "vue";
import XAccordionItem from "@ui-kit/accordion/XAccordionItem.vue";

export const XAccordionSymbol = Symbol();

export default defineComponent({
    props: {
        fullHeight: {
            type   : Boolean,
            default: false
        }
    },
    setup(props, {slots}) {
        const currentTab = ref();

        function selectTabHandler (name) {
            console.log(name);
            if (currentTab.value === name) {
                currentTab.value = null;
            }else {
                currentTab.value = name;
            }
        }

        onMounted(() => {
            const items = slots.default();
            if (!items?.length || items[0].type !== XAccordionItem) {
                return;
            }
            currentTab.value = items[0].props.name;
        })

        provide(XAccordionSymbol, {
            currentTab,
            selectTabHandler
        });

        return () => h(
            'div',
            {
                class: {
                    "x_accordion": true,
                    "flex-grow h-full": currentTab.value && props.fullHeight
                },
                role: "listbox"
            },
            slots.default()
        )
    }
})
</script>

<style scoped>
    .x_accordion {
        @apply flex flex-col rounded-md border-x border-b border-gray-200 dark:border-gray-600
    }
</style>
