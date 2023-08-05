import http from "@/utils/http.js";


export function fetchComponents() {
    return http.get("deluge/components");
}


export function createSnippet(data) {
    return http.post("deluge/snippets", data);
}

export function fetchSnippetArgumentById(id) {
    return http.get(`deluge/snippets/arguments/${id}`);
}

export function createSnippetArgument(data) {
    return http.post("deluge/snippets/arguments", data);
}

export function updateSnippetArgument(id, data) {
    return http.put(`deluge/snippets/arguments/${id}`, data);
}

export function deleteSnippetArguments(id, ) {
    return http.delete(`deluge/snippets/arguments/${id}`);
}
