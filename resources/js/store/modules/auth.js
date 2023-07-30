import {currentUserMock} from '@/mock/user';

export default {
    namespaced: true,
    state: () => ({
        user: currentUserMock()
    }),
    getters: {},
    actions: {},
    mutations: {},
}
