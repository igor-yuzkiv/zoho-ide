import http from "@/utils/http.js";


export function fetchComponents() {
    return http.get("deluge/components");
}


export function createSnippet(data) {
    return http.post("deluge/snippets", data);
}
