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
