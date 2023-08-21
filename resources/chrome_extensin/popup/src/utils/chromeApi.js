export const EVENT_TYPES = {
    injectCode: 'injectCode',
};

export const CONFIG = {
    eventMessage: "zla__message",
};

export function dispatchEvent(type, payload) {
    // eslint-disable-next-line no-undef
    chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
        function handler(type, payload, config) {
            const event = new CustomEvent(config.eventMessage, {"detail": {type, payload}});
            document.dispatchEvent(event);
        }

        // eslint-disable-next-line no-undef
        chrome.scripting
            .executeScript({
                target: {tabId: tabs[0].id},
                func:   handler,
                args:   [type, payload, CONFIG]
            })
            .then((r) => console.log('dispatchEvent', r));
    })
}
