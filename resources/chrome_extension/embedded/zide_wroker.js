function setTheme(theme) {
    if (!theme) {
        return;
    }
    const instance = getCodeMirrorInstance();
    const body = document.querySelector("body");

    const prevTheme = [...body.classList].find(c => c.startsWith('zide-theme-'));
    if (prevTheme) {
        body.classList.remove(prevTheme);
    }

    body.classList.add(`zide-theme-${theme}`);
    body.setAttribute("data-theme", theme)
    instance.cm.setOption("theme", theme);
}

function toggleLeftPanel(value) {
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

function getCodeMirrorInstance() {
    const cm = document.querySelector(".CodeMirror").CodeMirror;
    return cm.getDoc();
}

const eventHandlers = {
    injectCode            : (payload) => {
        if (payload?.code) {
            console.log("eventHandler:injectCode", payload)
            const cm = getCodeMirrorInstance();
            const currentPosition = cm.getCursor();
            cm.replaceRange(payload.code, currentPosition);
        }
    },
    setAppearancesSettings: (payload) => {
        console.log("eventHandler:setAppearancesSettings", payload)
        setTheme(payload?.theme);
        toggleLeftPanel(payload?.showLeftPanel);

        try {
            localStorage.setItem("zohoIdeSettings", JSON.stringify(payload));
        } catch (error) {
            console.error(error)
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

document.addEventListener("zla__message", listener);


function onMounted() {
    try {
        const settings = JSON.parse(localStorage.getItem("zohoIdeSettings"));
        eventHandlers.setAppearancesSettings(settings)
    } catch (error) {
        console.error(error)
    }
}

setTimeout(onMounted, 2000)
