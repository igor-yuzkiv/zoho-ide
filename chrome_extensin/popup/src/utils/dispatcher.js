export const EVENT_NAME = 'zla__message';

export const EVENT_TYPES = {
    injectCode: 'injectCode',
};

export function dispatch(type, payload) {
    const event = new CustomEvent(EVENT_NAME, {"detail": {type, payload}});
    document.dispatchEvent(event);
}
