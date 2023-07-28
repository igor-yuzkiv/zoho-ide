import http from "@/utils/http.js";


export function fetchComponents() {
    return http.get("deluge/components");
}
