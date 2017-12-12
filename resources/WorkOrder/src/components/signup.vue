<template>
    <div class="column">
        <q-card class="signup">
            <q-card-title>Create User</q-card-title>
            <q-card>
                <q-card-main>
                    <q-input type="text" float-label="First Name" v-model="first_name" />
                    <q-input type="text" float-label="Last Name" v-model="last_name" />
                    <q-input type="text" float-label="Username" v-model="username" />
                    <div v-if="created" class="row justify-end">
                        <q-btn class="text-blue" flat>Change Username</q-btn>
                    </div>
                    <template v-if="!created">
                        <q-input type="password" float-label="Password" v-model="password" />
                        <q-input type="password" float-label="Confirm Password" v-model="confirmPassword" />
                    </template>
                    <div class="row justify-end" v-else>
                        <q-btn class="text-blue" flat>Change Password</q-btn>
                    </div>
                </q-card-main>
                <q-card-separator />
                <q-list>
                    <c-phone :phones="phones" />
                    <c-email :emails="emails" />
                    <c-address :addresses="addresses" />
                </q-list>
            </q-card>
            <q-card-separator />
            <q-card-actions align="end">
                <q-btn class="text-green" ref="signup" @click="signup" flat>Signup</q-btn>
            </q-card-actions>
        </q-card>
    </div>
</template>

<script>
    import email from './custom/email';
    import phone from './custom/phone';
    import address from './custom/address';
	export default {
		components: {
			'c-email': email,
            'c-phone': phone,
            'c-address': address,
        },
        computed: {
			created () {
				return this.$store.state.signup.created;
            },
        	first_name: {
        		get () {
			        return this.$store.state.signup.first_name;
                },
                set (value) {
        			this.$store.commit('first_name', value);
                }
            },
            last_name: {
        		get () {
			        return this.$store.state.signup.last_name;
                },
                set (value) {
        			this.$store.commit('last_name', value);
                }
            },
            username: {
        		get () {
			        return this.$store.state.signup.username;
                },
                set (value) {
        			this.$store.commit('username', value);
                }
            },
            password: {
        		get () {
			        return this.$store.state.signup.password;
                },
                set (value) {
        			this.$store.commit('password', value);
                }
            },
	        confirmPassword: {
		        get () {
			        return this.$store.state.signup.confirmPassword;
		        },
		        set (value) {
			        this.$store.commit('confirmPassword', value);
		        }
	        },
			addresses () {
				return this.$store.state.signup.addresses;
            },
            phones () {
				return this.$store.state.signup.phones;
            },
            emails () {
				return this.$store.state.signup.emails;
            }
        },
        methods: {
        	signup () {
		        this.$refs.signup.loading = true;
        		this.$store.dispatch('signup').then(response => {
			        this.$refs.signup.loading = false;
                }).catch(error => {
			        this.$refs.signup.loading = false;
                });
            }
        }
	}
</script>

<style scoped>
    .signup{
        background-color: lightgrey;
        border: .1em solid grey;
    }
    .user-image{
        border-radius: 50%;
        height: 100px;
        width: 100px;
    }
</style>