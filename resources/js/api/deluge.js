import http from "@/utils/http.js";


export function fetchComponents() {
    return http.get("deluge/components");
}


/**
 * Snippets
 * */

export function fetchSnippet(id, includes = []) {
    let query = {};
    if (includes.length) {
        query['includes'] = includes.join(',');
    }

    return http.get(`deluge/snippets/${id}?${new URLSearchParams(query).toString()}`)
}

export function createSnippet(data) {
    return http.post("deluge/snippets", data);
}

export function updateSnippet(id, data) {
    return http.put(`deluge/snippets/${id}`, data);
}
