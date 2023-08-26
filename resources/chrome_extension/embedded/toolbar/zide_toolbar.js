const rootElement = document.getElementById("zide");
const container = document.getElementById("zide-container");

const data = {
    minimized: true,
    darkTheme: false,
    leftPanel: true,
}

function toggleBar() {
    data.minimized = !data.minimized;

    if (data.minimized) {
        rootElement.classList.add("zide-minimized");
        container.style.display = "none";
    } else {
        rootElement.classList.remove("zide-minimized");
        container.style.display = "block";
    }
}

document.getElementById("zla_btn_toggleBar").addEventListener("click", toggleBar);
