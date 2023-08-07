export const EVENT_NAME = 'zla__message';

export const TYPES = {
    insert_code: 'insert_code',
};

export function dispatch(type, payload) {
    const event = new CustomEvent(EVENT_NAME, {"detail": {type, payload}});
    document.dispatchEvent(event);
}