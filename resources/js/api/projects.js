import http from "@/utils/http.js";

export function fetchProject(projectId) {
    return http.get(`projects/${projectId}`);
}

export function fetchProjectFormMeta(projectId = null) {
    let url = 'projects/meta/form';
    if (projectId) {
        url += `/${projectId}`;
    }

    return http.get(url);
}
