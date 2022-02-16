const state = {
    type: null,
    message: null
};

const actions = {
    success({ commit }, message) {
        commit('success', message);
    },
    error({ commit }, message) {
        commit('error', message);
    },
    clear({ commit }) {
        commit('clear');
    }
};

const mutations = {
    success(state, message) {
        state.type = 'success';
        state.message = message;
        state.show = true;
    },
    error(state, message) {
        state.type = 'danger';
        state.message = message;
        state.show = true;
    },
    clear(state) {
        state.show = false;
        state.type = null;
        state.message = null;
    }
};

export const alert = {
    namespaced: true,
    state,
    actions,
    mutations
};
