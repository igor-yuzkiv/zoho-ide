/**
 * Snippets
 * */
import http from "@/utils/http.js";

export function fetchSnippets(page = 1, limit = 10, includes = []) {

    let query = {
        page, limit
    };
    if (includes.length) {
        query['includes'] = includes.join(',');
    }

    return http.get(`snippets?${new URLSearchParams(query).toString()}`);
}

export function fetchSnippet(id, includes = []) {
    let query = {};
    if (includes.length) {
        query['includes'] = includes.join(',');
    }

    return http.get(`snippets/${id}?${new URLSearchParams(query).toString()}`)
}

export function createSnippet(data) {
    return http.post("snippets", data);
}

export function updateSnippet(id, data) {
    return http.put(`snippets/${id}`, data);
}

export function deleteSnippet(id) {
    return http.delete(`snippets/${id}`);
}
