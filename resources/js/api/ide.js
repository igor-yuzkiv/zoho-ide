import http from "@/utils/http.js";

export function fetchIdeSuggestions() {
    return http.get("ide/suggestions");
}
