import Vue from 'vue';
import Vuex from 'vuex';
import global from './global';
import login from './login';
import signup from './signup';

Vue.use(Vuex);

export const store = new Vuex.Store({
	modules: {
		global, login, signup
	}
});