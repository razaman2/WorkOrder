export default {
	setToken: token => {
		token.expires_in = token.expires_in + Date.now();
		localStorage.setItem('work_order_token', JSON.stringify(token));
	},
	
	getToken: function () {
		let token = JSON.parse(localStorage.getItem('work_order_token'));
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
		localStorage.removeItem('work_order_token');
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
