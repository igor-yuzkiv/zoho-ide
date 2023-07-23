import 'quasar/src/css/index.sass'
import '@quasar/extras/material-icons/material-icons.css'

import {Quasar, Dialog, LoadingBar} from 'quasar'

export default function (app) {
    app.use(Quasar, {
        plugins: {Dialog, LoadingBar}
    })
}
