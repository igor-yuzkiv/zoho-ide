function zide_setTheme(theme) {
    if (!theme) {
        return;
    }
    const instance = zide_getCodeMirrorInstance();
    const body = document.querySelector("body");

    const prevTheme = [...body.classList].find(c => c.startsWith('zide-theme-'));
    if (prevTheme) {
        body.classList.remove(prevTheme);
    }

    body.classList.add(`zide-theme-${theme}`);
    body.setAttribute("data-theme", theme)
    instance.cm.setOption("theme", theme);
}

function zide_toggleLeftPanel(value) {
    if (typeof value !== "boolean") {
        return;
    }

    const node = document.querySelector("#delugeLeftPane");
    if (!node) {
        return;
    }
    document.querySelector("#delugeEditorCont").style.width = "100%";
    node.style.display = value ? "inline-block" : "none";
}

function zide_getCodeMirrorInstance() {
    const cm = document.querySelector(".CodeMirror").CodeMirror;
    return cm.getDoc();
}

const zide_eventHandlers = {
    injectCode            : (payload) => {
        if (payload?.code) {
            console.log("eventHandler:injectCode", payload)
            const cm = zide_getCodeMirrorInstance();
            const currentPosition = cm.getCursor();
            cm.replaceRange(payload.code, currentPosition);
        }
    },
    setAppearancesSettings: (payload) => {
        console.log("eventHandler:setAppearancesSettings", payload)
        zide_setTheme(payload?.theme);
        zide_toggleLeftPanel(payload?.showLeftPanel);

        try {
            localStorage.setItem("zohoIdeSettings", JSON.stringify(payload));
        } catch (error) {
            console.error(error)
        }
    }
};

async function zide_Listener(e) {
    console.log("zide__message", e)

    if (!e?.detail) {
        console.error('zide__message: no data')
        return;
    }

    const {type, payload} = e.detail;
    if (!type || !payload) {
        console.error('zide__message: invalid data')
        return;
    }

    if (zide_eventHandlers[type]) {
        zide_eventHandlers[type](payload);
    }
}

function zide_onMounted() {
    try {
        const settings = JSON.parse(localStorage.getItem("zohoIdeSettings"));
        zide_eventHandlers.setAppearancesSettings(settings)
    } catch (error) {
        console.error(error)
    }
}

document.addEventListener("zide__message", zide_Listener);
setTimeout(zide_onMounted, 2000)
