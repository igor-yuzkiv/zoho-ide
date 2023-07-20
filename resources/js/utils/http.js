import axios                from 'axios'

export const BASE_URL = '/api';


const http = axios.create({withCredentials: true});
http.defaults.withCredentials = true;

http.interceptors.request.use((config) => {
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        config.headers['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

    config.headers['X-Requested-With'] = 'XMLHttpRequest';
    config.headers['Content-type'] = 'application/json';
    config.withCredentials = true;
    config.baseURL = BASE_URL;
    return config;
});


export default http;
