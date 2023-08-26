export default {
    namespaced: true,
    state     : {
        theme        : localStorage.getItem('theme'),
        showLeftPanel: localStorage.getItem('showLeftPanel') === 'true',
        fullScreen: localStorage.getItem('fullScreen') === 'true',
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
        },
        SET_FULL_SCREEN: (state, value) => {
            state.fullScreen = value;
            localStorage.setItem('fullScreen', value ? 'true' : 'false');
        }
    }
}
