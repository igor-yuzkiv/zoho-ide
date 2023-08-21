const rootElement = document.getElementById("zlaBar");
const container = document.getElementById("zlaBar-container");

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

function toggleDelugeLeftPanel() {
    const node = document.querySelector("#delugeLeftPane");
    if (!node) {
        return;
    }
    document.querySelector("#delugeEditorCont").style.width = "100%";
    node.style.display = data.leftPanel ? "none" : "inline-block";
    data.leftPanel = !data.leftPanel;
}

document.getElementById("zla_btn_hideLeftPanel").addEventListener("click", toggleDelugeLeftPanel);
document.getElementById("zla_btn_toggleBar").addEventListener("click", toggleBar);
