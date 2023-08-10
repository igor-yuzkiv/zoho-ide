import {getRequest} from "@/utils/http.js";

export function fetchSnippets(page = 1, limit = 10, includes = []) {

    let query = {
        page, limit
    };
    if (includes.length) {
        query['includes'] = includes.join(',');
    }

    return getRequest(`snippets?${new URLSearchParams().toString()}`);
}
