import http from "@/utils/http.js";


export function fetchComponents() {
    return http.get("deluge/components");
}


export function createSnippet(data) {
    return http.post("deluge/snippets", data);
}

export function fetchArgumentById(id) {
    return http.get(`deluge/snippets/arguments/${id}`);
}

export function deleteSnippetArguments(id) {
    return http.delete(`deluge/snippets/arguments/${id}`);
}
