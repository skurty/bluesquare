const state = {
    tickets: [],
    ticket: null,
};

const actions = {
    loadTickets({ commit }, projectId) {
        return axios
            .get('/api/projects/' + projectId + '/tickets')
            .then(response => {
                commit('setTickets', response.data)
            })
    },
    getTicket({ commit }, payload) {
        return axios
            .get('/api/projects/' + payload.projectId + '/tickets/' + payload.ticketId)
            .then(response => {
                commit('setTicket', response.data)
            })
    },
    updateTicket({ commit }, id) {
        return axios.patch('/api/tickets/' + id, state.ticket)
    },
};

const mutations = {
    setTickets(state, data) {
        state.tickets = data;
    },
    setTicket(state, data) {
        state.ticket = data;
    },
};

export const ticket = {
    namespaced: true,
    state,
    actions,
    mutations
};
