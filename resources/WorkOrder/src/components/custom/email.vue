<template>
    <q-collapsible icon="email">
        <q-list v-if="emails.length" highlight>
            <q-item tag="div"  v-for="(email, index) in emails" :key="index" @click="edit(index)">
                <q-item-side>
                    {{ email.type }}
                </q-item-side>
                <q-item-main>
                    {{ email.email }}
                </q-item-main>
                <q-item-side right @click.stop="destroy(index)">
                    <q-icon name="delete" color="red" size="1.5em" />
                </q-item-side>
            </q-item>
        </q-list>
        <q-list v-if="email.email" link dense no-border>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="email.type" val="Personal" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile title>Personal</q-item-tile>
                </q-item-main>
            </q-item>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="email.type" val="Work" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>Work</q-item-tile>
                </q-item-main>
            </q-item>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="email.type" val="Other" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>Other</q-item-tile>
                </q-item-main>
            </q-item>
        </q-list>
        <q-input type="email" :float-label="email.type" v-model="email.email" />
        <div class="row justify-end">
            <template v-if="email.edit !== null">
                <q-btn class="text-red" flat @click="reset">Cancel</q-btn>
                <q-btn class="text-green" flat @click="save">Save</q-btn>
            </template>
            <q-btn class="text-green" v-else flat @click="add">Add</q-btn>
        </div>
    </q-collapsible>
</template>

<script>
	export default {
		data () {
			return {
				email: {
					type: 'Personal', email: null, edit: null,
				}
            }
        },
		props: ['emails'],
        methods: {
	        add () {
		        this.$store.commit('addEmail', {email: Object.assign({}, this.email)});
		        this.reset();
	        },
	        edit (index) {
		        let email = this.emails[index];
		        for(let key in email) {
			        this.email[key] = email[key];
		        }
		        this.email.edit = index;
		        this.$store.commit('editEmail', {index, email: Object.assign({}, this.email)});
	        },
            save () {
	        	this.$store.commit('editEmail', {index: this.email.edit, email: Object.assign({}, this.email)});
	        	this.reset();
            },
	        destroy (index) {
		        this.$store.commit('deleteEmail', {index});
	        },
            reset () {
	        	this.email.type = 'Personal';
	        	this.email.email = null;
	            this.email.edit = null;
            }
        }
	};
</script>