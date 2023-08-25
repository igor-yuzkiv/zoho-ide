import {createStore} from "vuex";
import {dispatchEvent, EVENT_TYPES} from "@/utils/chromeApi.js";
const store = createStore({
    state    : {
        theme     : localStorage.getItem('theme'),
    },
    getters  : {},
    actions  : {},
    mutations: {
        SET_THEME: (state, value) =>  {
            console.log(value);
            state.theme = value;
            localStorage.setItem('theme', value);
            dispatchEvent(EVENT_TYPES.changeTheme, {theme: value});
        },
    }
})

export default store;
