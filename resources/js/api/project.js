import http from "@/utils/http.js";
export function fetchProjects() {
    return http.get("projects");
}

export function fetchProject(id) {
    return http.get(`projects/${id}`);
}

export function createProject(data) {
    return http.post("projects", data);
}

export function updateProject(id, data) {
    return http.put(`projects/${id}`, data);
}

export function deleteProject(id) {
    return http.delete(`projects/${id}`);
}

export function fetchProjectConnections(id) {
    return http.get(`projects/${id}/connections`);
}
