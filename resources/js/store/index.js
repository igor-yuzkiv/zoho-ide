import {createStore} from "vuex";
import confirmDialog from "@/store/confirmDialog.js";
const store = createStore({
    //strict: proce.env.NODE_ENV !== 'production',
    state    : {},
    getters  : {},
    actions  : {},
    mutations: {},
    modules  : {
        confirmDialog
    },
})

export default store;
