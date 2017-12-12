export default {
	state: {
		created: null,
		addresses: [],
		phones: [],
		emails: [],
		roles: [],
		first_name: null,
		last_name: null,
		username: null,
		password: null,
		confirmPassword: null,
	},
	mutations: {
		created (state, payload) {
			state.created = payload;
		},
		first_name (state, payload) {
			state.first_name = payload;
		},
		last_name (state, payload) {
			state.last_name = payload;
		},
		username (state, payload) {
			state.username = payload;
		},
		password (state, payload) {
			state.password = payload;
		},
		confirmPassword (state, payload) {
			state.confirmPassword = payload;
		},
		initPhones (state, payload) {
			state.phones = payload;
		},
		addPhone (state, payload) {
			state.phones.push(payload.phone);
		},
		editPhone (state, payload) {
			state.phones.splice(payload.index, 1, payload.phone);
		},
		deletePhone (state, payload) {
			state.phones.splice(payload.index, 1);
		},
		initEmails (state, payload) {
			state.emails = payload;
		},
		addEmail (state, payload) {
			state.emails.push(payload.email);
		},
		editEmail (state, payload) {
			state.emails.splice(payload.index, 1, payload.email);
		},
		deleteEmail (state, payload) {
			state.emails.splice(payload.index, 1);
		},
		initAddresses (state, payload) {
			state.addresses = payload;
		},
		addAddress (state, payload) {
			state.addresses.push(payload.address);
		},
		editAddress (state, payload) {
			state.addresses.splice(payload.index, 1, payload.address);
		},
		deleteAddress (state, payload) {
			state.addresses.splice(payload.index, 1);
		},
		addRole (state, payload) {
			state.roles.push(payload.role);
		},
		removeRole (state, payload) {
			state.roles.splice(payload.index, 1);
		},
		initRoles (state, payload) {
			state.roles = payload;
		}
	},
	actions: {
		signup: context => {
			http.post('/signup', {user: context.state}).then(response => {
				console.log('Signup', response);
				if(response.data.id) {
					context.commit('created', response.data.id);
					context.commit('first_name', response.data.first_name);
					context.commit('last_name', response.data.last_name);
					context.commit('initEmails', response.data.emails);
					context.commit('initPhones', response.data.phones);
					context.commit('initAddresses', response.data.addresses);
					context.commit('initRoles', response.data.roles);
				}
			}).catch(error => {
				console.log(error);
			});
		}
	}
}