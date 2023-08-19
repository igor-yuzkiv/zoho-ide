const rootElement = document.getElementById("zlaBar");
const container = document.getElementById("zlaBar-container");

const THEMES = {
    default: "default",
    dark:    "ayu-dark",
}

const data = {
    minimized: true,
    darkTheme: false,
    leftPanel: true,
}

function toggleBar() {
    data.minimized = !data.minimized;
    if (data.minimized) {
        rootElement.classList.add("zlaBar-minimized");
        container.style.display = "none";
    } else {
        rootElement.classList.remove("zlaBar-minimized");
        container.style.display = "block";
    }
}

/**
 * https://codemirror.net/5/demo/theme.html
 * https://github.com/codemirror/codemirror5/blob/master/demo/theme.html
 * https://github.com/codemirror/codemirror5/tree/master/theme
 */
function changeTheme() {
    const instance = getCodeMirrorInstance();
    if (data.darkTheme) {
        instance.cm.setOption("theme", THEMES.default);
    } else {
        instance.cm.setOption("theme", THEMES.dark);
    }
    data.darkTheme = !data.darkTheme;
}

function hideCmLeftPanel() {
    const node = document.querySelector("#delugeLeftPane");
    if (!node) {
        return;
    }

    if (data.leftPanel) {
        node.style.display = "none";
    } else {
        node.style.display = "inline-block";
    }
    data.leftPanel = !data.leftPanel;
}

document.getElementById("zla_btn_hideLeftPanel").addEventListener("click", hideCmLeftPanel);
document.getElementById("zla_btn_toggleBar").addEventListener("click", toggleBar);
document.getElementById("zla_btn_changeTheme").addEventListener("click", changeTheme);
