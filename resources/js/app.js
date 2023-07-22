import { Quasar } from 'quasar'

import './style/tailwind.css'

import 'quasar/src/css/index.sass'
import '@quasar/extras/material-icons/material-icons.css'


import App          from './App.vue'
import {createApp}  from 'vue'
import router       from './router';
import {toast}      from "vue3-toastify";
import Vue3Toastify from 'vue3-toastify';
import http         from "@/utils/http";
import store from '@/store';

const app = createApp(App)
app.use(store)
app.use(router)
app.use(Vue3Toastify)
app.provide('toast', toast)
app.provide("http", http)

app.use(Quasar, {
    plugins: {}, // import Quasar plugins and add here
})

import { InstallCodemirro } from "codemirror-editor-vue3";
app.use(InstallCodemirro);

app.mount('#app')
