export const EVENT_TYPES = {
    injectCode: 'injectCode',
};
export const EVENT_MESSAGE = "zla__message";

export function dispatchEvent(type, payload) {
    // eslint-disable-next-line no-undef
    chrome.tabs.query({active: true, currentWindow: true}, function (tabs) {
        function handler(type, payload, config) {
            const event = new CustomEvent(config.message, {"detail": {type, payload}});
            document.dispatchEvent(event);
        }

        // eslint-disable-next-line no-undef
        chrome.scripting
            .executeScript({
                target: {tabId: tabs[0].id},
                func:   handler,
                args:   [type, payload, {message: EVENT_MESSAGE}]
            })
            .then((r) => console.log('dispatchEvent', r));
    })
}
