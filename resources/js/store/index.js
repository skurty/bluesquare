import Vue from 'vue';
import Vuex from 'vuex';

import { alert } from './alert.module';
import { project } from './project.module';
import { ticket } from './ticket.module';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        alert,
        project,
        ticket
    }
});
