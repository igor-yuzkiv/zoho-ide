### popup.js

```js
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById("test"); // click button in popup
    button.addEventListener("click", function () {
        chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
            chrome.tabs.sendMessage(tabs[0].id, {data: "text"}, function (response) {
                console.log('success');
            });
        });
    });

    console.log("Extension loaded")

});
```

### content-script.js
```js
chrome.runtime.onMessage.addListener(function (request, sender, sendResponse) {
    console.log("content-script.message", request); //{data: "text"}
});
```