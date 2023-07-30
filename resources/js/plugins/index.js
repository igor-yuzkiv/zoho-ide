import router from '@/router';
import http from "@/utils/http";
import store from '@/store';

import '@/style/tailwind.css'

import toasity from "@/plugins/toasity.js";
import codemirror from "@/plugins/codemirror.js";

export function registerPlugins(app) {
    app.use(store)
    app.use(router)
    app.provide("http", http)

    toasity(app);
    codemirror(app);
}
