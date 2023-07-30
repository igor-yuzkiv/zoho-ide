import {createStore} from "vuex";
const APP_NAME = import.meta.env.VITE_APP_NAME;
import auth from "./modules/auth";

const store = createStore({
    state    : {
        pageTitle: "",
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
    },
    modules: {
        auth
    }
})

export default store;
