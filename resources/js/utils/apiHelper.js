import http from "@/utils/http.js";

export function fetchEntities(endpoint, page = 1, limit = 10, includes = [], filters = []) {
    let query = {
        page, limit
    };

    if (Array.isArray(includes) && includes.length) {
        query['includes'] = includes.join(',');
    }

    if (Array.isArray(filters) && filters?.length) {
        for (let index = 0; index < filters.length; index++) {
            query[`filter[${index}]`] = filters[index];
        }
    }

    return http.get(`${endpoint}?${new URLSearchParams(query).toString()}`);
}
