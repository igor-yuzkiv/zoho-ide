const defaultConfig = () => ({
    name: "Confirmation",
    subject: "",
    message: "",
    confirmButton: "Agree",
    cancelButton: "Cancel",
})

export default {
    namespaced: true,
    state: () => ({
        isOpen: false,
        config: defaultConfig(),
        resolve: null,
        reject: null,
    }),
    actions: {
        async openDialog({state, commit}, payload = {
            config: defaultConfig()
        }) {
            commit("mutateConfig", payload.config)
            commit("mutateIsOpen", true)

            return new Promise((resolve, reject) => {
                state.resolve = resolve;
                state.reject = reject;
            })
        }
    },
    mutations: {
        mutateIsOpen: (state, value) => state.isOpen = value,
        mutateConfig(state, config) {
            state.config = Object.assign(defaultConfig(), config);
        },
        closeDialog(state) {
            state.isOpen = false;
            state.config = defaultConfig();
        }
    },
}
