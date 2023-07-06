### popup.js

```js
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById("test");
    button.addEventListener("click", function () {
        chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
            async function insertCode() {
                const code = await fetch("https://store.igoryuzkiv.tech/api/test", {
                    method:  "GET",
                    headers: {
                        Accept:         "application/json",
                        "Content-Type": "application/json;charset=UTF-8",
                    }
                })
                    .then((response) => response.json())
                    .then((data) => data?.code ?? '');

                const event = new CustomEvent("zohoLazyAss__insertInCurrentPosition", {"detail": code});
                document.dispatchEvent(event);
            };

            chrome.scripting.executeScript({
                target: {tabId: tabs[0].id},
                func:   insertCode,
            }).then(() => console.log('Injected a function!'));
        });
    });
});
```

### embedded.js
```js
document.addEventListener("zohoLazyAss__insertInCurrentPosition", async function (e) {
    if (e?.detail) {
        const code = e?.detail;
        const cm = document.querySelector(".CodeMirror").CodeMirror;
        const doc = cm.getDoc();
        const currentPosition = doc.getCursor();
        console.log("currentPosition", currentPosition)
        doc.replaceRange(code, currentPosition);
    }
})
```