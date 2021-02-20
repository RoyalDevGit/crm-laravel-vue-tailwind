import Vue from 'vue';
import Vuex from 'vuex';
import theme from "./modules/theme";
import users from "./modules/users";

Vue.use(Vuex);

export default new Vuex.Store({
    modules : {
        users,
        theme
    }
});
