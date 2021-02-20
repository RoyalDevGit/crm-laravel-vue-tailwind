const state = {
    user: {}
};

const getters = {
    getUser: state => {
        return state.user;
    }
};

const actions = {
    actionsUser({commit}) {
        axios.get('/users')
            .then(res => {
                commit('setUser', res.data.data);
            })
            .catch(error => {
                console.log('Unable to fetch auth user');
            });
    },
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    }
};
export default {
    state, getters, actions, mutations,
}
