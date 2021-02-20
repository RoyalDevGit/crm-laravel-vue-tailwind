const state = {
    theme : {},
    sideBarOpen : false,
    dropDownOpen : false,
    toggle : false,
};

const getters = {
    getTheme: state => {
        return state.theme;
    },
    getSideBarOpen : state => {
        return state.sideBarOpen
    },
    getDropDownOpen : state => {
        return state.dropDownOpen
    },
    getToggle : state => {
        return state.toggle
    }
};


const actions = {
    initTheme({commit}){
        const cachedTheme = localStorage.theme ? localStorage.theme : false;
        // İşlem true gelirse kullanıcının teması dark olarak güncellenir.

        if(cachedTheme)
            commit('setTheme',cachedTheme)
        else
            commit('setTheme','light')
    },
    toggleTheme({ commit }) {
        switch (localStorage.theme) {
            case 'light':
                commit('setTheme', 'dark')
                break;

            default:
                commit('setTheme', 'light')
                break;
        }
    },
    changeState({commit}, {name, data}){
        commit(name,data);
    }
};

const mutations = {
    setTheme(state,theme){
        state.theme = theme;
        localStorage.theme = theme;
    },
    setSideBarOpen(state,sideBarOpen){
        state.sideBarOpen = sideBarOpen
    },
    setDropDownOpen(state,dropDownOpen){
        state.dropDownOpen = dropDownOpen
    },
    setToggle(state,toggle){
        state.toggle = toggle
    }
};
export default {
    state,getters,actions,mutations,
}
