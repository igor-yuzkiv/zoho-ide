import http from "@/utils/http.js";

export function createConnection(data) {
    return http.post("connections", data);
}

export function updateConnection(id, data) {
    return http.put(`connections/${id}`, data);
}

export function authorizeConnection(id) {
    return http.post(`connections/${id}/authorize`);
}
