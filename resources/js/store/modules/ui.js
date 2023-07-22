
export default {
    namespaced: true,
    state: () => ({
        contextMenuItems: [],
    }),
    getters: {},
    actions: {},
    mutations: {
        SET_CONTEXT_MENU_ITEMS: (state, payload) => state.contextMenuItems = payload,
    },
}
