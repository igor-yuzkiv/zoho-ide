const rootElement = document.getElementById("zide_toolBar");
const data = {
    minimized: true,
    darkTheme: false,
    leftPanel: true,
}

function toggleBar() {
    data.minimized = !data.minimized;

    if (data.minimized) {
        rootElement.classList.add("zide_toolBar-minimize");
    } else {
        rootElement.classList.remove("zide_toolBar-minimize");
    }
}

document.getElementById("zide_toolBar-toggle-btn").addEventListener("click", toggleBar);
