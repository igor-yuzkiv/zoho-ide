import http from "@/utils/http.js";


export function fetchEditorSuggestions() {
    return http.get("deluge/editor/suggestion");
}
