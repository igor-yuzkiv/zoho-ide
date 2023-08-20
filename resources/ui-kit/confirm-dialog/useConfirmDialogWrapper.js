import {reactive, ref} from "vue";

const isOpen = ref(false);
const options = reactive({
    title  : "Confirmation",
    message: ''
});
const result = ref(null);

function openDialog(message, title = 'Confirmation') {
    options.title = title;
    options.message = message;
    result.value = null;
    isOpen.value = true;

    return new Promise((resolve) => {
        result.value = resolve;
    })
}

function confirmHandle() {
    result.value(true);
    closeDialog();
}

function cancelHandle() {
    closeDialog();
}

function closeDialog() {
    result.value(false);
    isOpen.value = false;
}

export {
    isOpen,
    closeDialog,
    openDialog,
    confirmHandle,
    cancelHandle,
    options,
}
