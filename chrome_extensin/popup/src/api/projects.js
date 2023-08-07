import {getRequest, postRequest, putRequest, deleteRequest} from "@/utils/http.js";
export function fetchProjects(include = []) {
    return getRequest(`projects?include=${include.join(",")}`);
}

export function fetchProject(id, include = []) {
    return getRequest(`projects/${id}?include=${include.join(",")}`);
}