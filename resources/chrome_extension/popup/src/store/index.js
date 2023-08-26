import {createStore} from "vuex";

import settings from "@/store/settings.js";

const store = createStore({
    state    : {},
    getters  : {},
    actions  : {},
    mutations: {},
    modules: {
        settings
    }
})

export default store;
