export function dispatchEvent(type, payload) {
    chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
        function handler(type, payload) {
            const event = new CustomEvent('zla__message', {"detail": {type, payload}});
            document.dispatchEvent(event);
        }

        chrome.scripting
            .executeScript({
                target: {tabId: tabs[0].id},
                func:   handler,
                args:   [type, payload]
            })
            .then((r) => console.log('dispatchEvent', r));
    })
}