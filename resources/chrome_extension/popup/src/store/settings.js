export default {
    namespaced: true,
    state     : {
        theme        : localStorage.getItem('theme'),
        showLeftPanel: localStorage.getItem('showLeftPanel') === 'true',
    },
    actions: {},
    getters   : {},
    mutations : {
        SET_THEME          : (state, value) => {
            state.theme = value;
            localStorage.setItem('theme', value);
        },
        SET_SHOW_LEFT_PANEL: (state, value) => {
            state.showLeftPanel = value;
            localStorage.setItem('showLeftPanel', value ? 'true' : 'false');
        }
    }
}
