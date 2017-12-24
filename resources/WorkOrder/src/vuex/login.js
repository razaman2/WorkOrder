import auth from "../packages/auth/auth";

export default {
	actions: {
		login: (context, user) => {
			return new Promise((resolve, reject) => {
				http.post('http://workorder.sable:8000/oauth/token', {
					username: user.email,
					password: user.password,
					client_id: 2,
					client_secret: 'SBPWLi9KqsA01n9PEjhrNnyEWwqzoWvUk3ccsu9C',
					grant_type: 'password',
				}).then(response => {
					auth.setToken(response.data);
					context.commit('authentication');
					resolve(auth.isAuthenticated());
				}).catch(error => {
					reject('failed to log user in ' + error);
				});
			});
		},
		
		logout: context => {
			return new Promise((resolve, reject) => {
				auth.destroyToken();
				if(!auth.isAuthenticated())
				{
					context.commit('authentication');
					resolve(auth.isAuthenticated());
				} else {
					reject('failed to log user out');
				}
			});
		},
		
		authUser: context => {
			http.post('/user', {id: 10}).then(response => {
				context.commit('first_name', response.data.first_name);
				context.commit('last_name', response.data.last_name);
				context.commit('initEmails', response.data.emails);
				context.commit('initPhones', response.data.phones);
				context.commit('initAddresses', response.data.addresses);
				console.log(response);
			}).catch(error => {
				console.log(error);
			})
		}
	}
}