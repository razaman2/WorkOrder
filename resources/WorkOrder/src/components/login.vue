<template>
    <div class="column">
        <q-card class="login">
            <q-card-main>
                <q-input type="email" v-model="email" float-label="Username" />
                <q-input type="password" v-model="password" float-label="Password" />
            </q-card-main>
            <q-card-separator />
            <q-card-actions align="end">
                <q-btn ref="login" class="text-green" flat @click="login">Login</q-btn>
            </q-card-actions>
        </q-card>
    </div>
</template>

<script>
	export default {
		data () {
			return {
				email: null,
				password: null,
			}
		},
		methods:{
			login () {
				this.$refs.login.loading = true;
				this.$store.dispatch('login', {email: this.email, password: this.password}).then(status => {
					if(status) {
						this.$router.push('/dashboard');
					}
				}).catch(error => {
					this.$refs.login.loading = false;
					console.log(error);
				});
			}
		}
	}
</script>

<style scoped>
    .login{
        background-color: lightgrey;
        border: .1em solid grey;
    }
</style>