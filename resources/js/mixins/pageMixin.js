const APP_NAME = import.meta.env.VITE_APP_NAME;

export function setPageTitle(title) {
    document.title = `${title} | ${APP_NAME}`;
}
