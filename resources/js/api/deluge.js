import http from "@/utils/http.js";

export function fetchDelugeComponents() {
    return http.get("deluge/components");
}
