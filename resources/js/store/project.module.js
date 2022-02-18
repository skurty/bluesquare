const state = {
    projects: [],
    project: null
};

const actions = {
    loadProjects({ commit }) {
        return axios
            .get('/api/projects')
            .then(response => {
                commit('setProjects', response.data)
            })
    },
    getTicket({ commit }, id) {
        console.log('get project ' + id);
        return axios
            .get('/api/project/' + id)
            .then(response => {
                commit('setProject', response.data)
            })
    },
    updateTicket({ commit }, id) {
        return axios.patch('/api/tickets/' + id, state.ticket.data)
    },
};

const mutations = {
    setProjects(state, data) {
        state.projects = data;
    },
    setProject(state, data) {
        state.project = data;
    },
};

export const project = {
    namespaced: true,
    state,
    actions,
    mutations
};
