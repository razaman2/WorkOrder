<template>
  <!-- Don't drop "q-app" class -->
  <q-pull-to-refresh :handler="refresh">
      <q-layout id="q-app">
          <q-toolbar v-if="authenticated" color="primary">
              <q-btn flat round icon="menu" />
              <q-toolbar-title style="cursor: pointer" @click="$router.push('/')">GMI WorkOrder</q-toolbar-title>
              <q-tabs slot="navigation">
                  <template v-if="!authenticated">
                      <q-route-tab slot="title" to="/login" label="Login" />
                      <q-route-tab slot="title" to="/signup" label="Signup" />
                  </template>
                  <q-tab v-else slot="title" label="Logout" @click="logout" />
              </q-tabs>
          </q-toolbar>
          <router-view />
      </q-layout>
  </q-pull-to-refresh>
</template>

<script>
    export default {
        computed: {
    		authenticated () {
    			return this.$store.state.global.isAuthenticated;
            }
        },
    	methods: {
        	refresh (done) {
        		return done();
            },
    		logout () {
    			this.$store.dispatch('logout').then(status => {
    				if(!status) {
					    this.$router.push('/');
                    }
                }).catch(error => {
                	console.log(error);
                })
            }
        }
    }
</script>

<style scoped>
    #q-app{

    }
</style>
