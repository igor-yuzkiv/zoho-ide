import {openDialog, closeDialog} from "./useConfirmDialogWrapper.js";

export function useConfirmDialog() {
    return {
        open : openDialog,
        close: closeDialog,
    }
}

export function useConfirmBeforeAction() {
    const open = async (action, message, title = 'Confirmation') => {
        const confirm = await openDialog(message, title);
        if (confirm) {
            action();
        }
    }

    return {open};
}
