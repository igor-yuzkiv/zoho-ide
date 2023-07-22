import http from "@/utils/http.js";


export function getConnection(id, includes = []) {
    return http.get(`connections/${id}?include=${includes.join(",")}`);
}

export function getConnectionAuthorizationUrl(id) {
    return http.get(`connections/${id}/authorization-url`);
}

export function createConnection(data) {
    return http.post("connections", data);
}

export function updateConnection(id, data) {
    return http.put(`connections/${id}`, data);
}

export function authorizeConnection(id) {
    return http.post(`connections/${id}/authorize`);
}
