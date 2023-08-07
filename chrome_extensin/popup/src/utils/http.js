export const BASE_URI = 'https://store.igoryuzkiv.tech/api/';

const defaultConfig = {
    mode:           "cors",
    cache:          "no-cache",
    credentials:    "same-origin",
    redirect:       "follow",
    referrerPolicy: "no-referrer",
};

function getUrl(url) {
    return BASE_URI + url;
}

export async function getRequest(url = "", query = {}) {
    const response = await fetch(getUrl(url), {
        ...defaultConfig,
        method: "GET",
    })
    return response.json();
}

export async function postRequest(url = "", data = {}) {
    const response = await fetch(getUrl(url), {
        method:         "POST",
        ...defaultConfig,
        headers:        {
            "Content-Type": "application/json",
        },
        body:           JSON.stringify(data),
    });
    return response.json();
}



export async function putRequest(url = "", data = {}) {

}

export async function deleteRequest(url = "", data = {}) {

}