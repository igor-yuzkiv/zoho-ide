import {createStore} from "vuex";
const APP_NAME = import.meta.env.VITE_APP_NAME;
const store = createStore({
    state    : {
        pageTitle: "",
        darkTheme     : true,
    },
    getters  : {
        appName: () => APP_NAME,
    },
    actions  : {},
    mutations: {
        SET_PAGE_TITLE: (state, payload) => {
            state.pageTitle = payload;
            document.title = `${payload} | ${APP_NAME}`;
        },
        SET_DARK_THEME: (state, payload) => state.darkTheme = payload,
    }
})

export default store;
