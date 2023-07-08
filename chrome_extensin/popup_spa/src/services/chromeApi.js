export const injectCode = (code) => {
    chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
        async function insertCode(code) {
            const event = new CustomEvent("zohoLazyAss__insertInCurrentPosition", {"detail": code ?? "undefined"});
            document.dispatchEvent(event);
        }

        chrome.scripting.executeScript({
            target: {tabId: tabs[0].id},
            func  : insertCode,
            args: [code]
        }).then((r) => console.log('injectCode', r));
    });
}
