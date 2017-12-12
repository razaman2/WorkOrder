// === DEFAULT / CUSTOM STYLE ===
// WARNING! always comment out ONE of the two require() calls below.
// 1. use next line to activate CUSTOM STYLE (./src/themes)
// require(`./themes/app.${__THEME}.styl`)
// 2. or, use next line to activate DEFAULT QUASAR STYLE

require(`quasar/dist/quasar.${__THEME}.css`);
// ==============================

// Uncomment the following lines if you need IE11/Edge support
// require(`quasar/dist/quasar.ie`)
// require(`quasar/dist/quasar.ie.${__THEME}.css`)

import Vue from 'vue';
import Quasar, * as All from 'quasar';
import router from './router';

Vue.config.productionTip = false;
Vue.use(Quasar, {
	components: All,
	directives: All,
}); // Install Quasar Framework

if (__THEME === 'mat') {
	require('quasar-extras/roboto-font');
}
import 'quasar-extras/material-icons';
// import 'quasar-extras/ionicons'
// import 'quasar-extras/fontawesome'
// import 'quasar-extras/animate'
import moment from 'moment';
import axios from 'axios';
import swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'sweetalert2/dist/sweetalert2.all.min';
import { store } from './vuex/store';
import auth from './packages/auth/auth';

Window.prototype.swal = swal;
Window.prototype.moment = moment;
Window.prototype.auth = auth;
Window.prototype.http = axios.create({
	// baseURL: 'http://192.168.1.102:8000/api',
	baseURL: 'http://192.168.123.107:8000/api',
});

http.interceptors.response.use(response => {
	return response;
});

http.interceptors.request.use(config => {
	config.data.clientTime = moment().format('YYYY-MM-DD HH:mm:ss');
	return config;
});

Quasar.start(() => {
	/* eslint-disable no-new */
	Window.prototype.Vue = new Vue({
		el: '#q-app',
		created () {
			this.$store.commit('authentication');
		},
		router, store,
		render: h => h(require('./App').default)
	})
});
