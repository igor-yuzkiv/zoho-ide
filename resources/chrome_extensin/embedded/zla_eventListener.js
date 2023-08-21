const ZLA_THEMES = {
    default: "default",
    dark:    "dark",
}

function getCodeMirrorInstance() {
    const cm = document.querySelector(".CodeMirror").CodeMirror;
    return cm.getDoc();
}

const eventHandlers = {
    injectCode: (payload) => {
        if (payload?.code) {
            console.log("eventHandler:injectCode", payload)
            const cm = getCodeMirrorInstance();
            const currentPosition = cm.getCursor();
            cm.replaceRange(payload.code, currentPosition);
        }
    },
    changeTheme: (payload) => {
        /**
         * https://codemirror.net/5/demo/theme.html
         * https://github.com/codemirror/codemirror5/blob/master/demo/theme.html
         * https://github.com/codemirror/codemirror5/tree/master/theme
         */
        if (payload?.theme) {
            const instance = getCodeMirrorInstance();
            const isDark = payload.theme === "dark";
            const body = document.querySelector("body");

            if (isDark) {
                body.classList.add('zlaBar-darkTheme');
                instance.cm.setOption("theme", ZLA_THEMES.dark);
                body.setAttribute("data-theme", ZLA_THEMES.dark)
            } else {
                body.classList.remove('zlaBar-darkTheme');
                body.setAttribute("data-theme", ZLA_THEMES.default)
                instance.cm.setOption("theme", ZLA_THEMES.default);
            }
        }
    }
};

async function listener(e) {
    console.log("zla__message", e)

    if (!e?.detail) {
        console.error('zla__message: no data')
        return;
    }

    const {type, payload} = e.detail;
    if (!type || !payload) {
        console.error('zla__message: invalid data')
        return;
    }

    if (eventHandlers[type]) {
        eventHandlers[type](payload);
    }
}

document.addEventListener("zla__message", listener)


function test() {
    const cm = getCodeMirrorInstance();
    console.log("cm", cm)
}

setTimeout(() => test(), 1000);
