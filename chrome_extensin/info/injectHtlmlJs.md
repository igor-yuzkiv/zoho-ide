### content-script.js

```js
async function injectHtml(file_path, querySelector) {
    await fetch(chrome.runtime.getURL(file_path)).then(r => r.text()).then(html => {
        const node = document.querySelector(querySelector);
        node.insertAdjacentHTML('afterbegin', html)
    });
}

function injectScript(file_path, tag) {
    var node = document.getElementsByTagName(tag)[0];
    var script = document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', file_path);
    node.appendChild(script);
}

injectHtml('embedded/embedded.html', '#delugeEditorEle')
setTimeout(() => injectScript(chrome.runtime.getURL('embedded/embedded.js'), 'body'), 1000)
```
### embedded.js
```js
const x__testInsertCode = document.getElementById("x__testInsertCode");
x__testInsertCode.addEventListener("click", async () => {
    const cm = document.querySelector(".CodeMirror").CodeMirror;
    const doc = cm.getDoc();

    const code = await fetch("https://store.igoryuzkiv.tech/api/test", {
        method:  "GET",
        headers: {
            Accept:         "application/json",
            "Content-Type": "application/json;charset=UTF-8",
        }
    })
        .then((response) => response.json())
        .then((data) => data?.code ?? '');

    const currentPosition = doc.getCursor();
    console.log("currentPosition", currentPosition)
    doc.replaceRange(code, currentPosition);
})
```

### embedded.html
```html
<div id="relative x__zohoLazyAss">
    <button
            id="x__testInsertCode"
            class="p-2 rounded-full bg-green-50"
    >
        Insert
    </button>
</div>
```