export default {
	state: {
		isAuthenticated: false,
	},
	mutations: {
		authentication: state => {
			state.isAuthenticated = auth.isAuthenticated();
			http.defaults.headers.common['Authorization'] = auth.getToken() ? 'Bearer ' + auth.getToken().access_token : null;
		}
	}
}