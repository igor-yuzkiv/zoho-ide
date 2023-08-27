import http from "@/utils/http.js";
import {fetchEntities} from "@/utils/apiHelper.js";

export function fetchProjects(page = 1, limit = 10, includes = [], filters = []) {
    return fetchEntities('projects', page, limit, includes, filters);
}

export function fetchProject(projectId) {
    return http.get(`projects/${projectId}`);
}

export function fetchProjectFormMeta() {
    return http.get('projects/meta/form');
}
