import {LocalStorage} from 'quasar';

export default {
	setToken: token => {
		token.expires_in = token.expires_in + Date.now();
		LocalStorage.set('work_order_token', token);
	},
	
	getToken: function () {
		let token = LocalStorage.get.item('work_order_token');
		if(!token || !token.access_token || !token.expires_in) {
			return null;
		}
		if(Date.now() > token.expires_in) {
			this.destroyToken();
			return null;
		} else {
			return token;
		}
	},
	
	destroyToken: () => {
		LocalStorage.remove('work_order_token');
	},
	
	isAuthenticated: function () {
		return !!this.getToken();
	}
};

// Object.defineProperties(Vue.prototype, {
// 	auth: {
// 		get: () => {
// 			return Vue.auth;
// 		}
// 	}
// });
