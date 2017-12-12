<template>
    <q-collapsible icon="location_on">
        <q-list v-if="addresses.length" highlight>
            <q-item tag="div"  v-for="(address, index) in addresses" :key="index" @click="edit(index)">
                <q-item-side>
                    {{ address.type }}
                </q-item-side>
                <q-item-main>
                    {{ address.street_1 }}, {{ address.city }} {{ address.state }} {{ address.country }}
                </q-item-main>
                <q-item-side right @click.stop="destroy(index)">
                    <q-icon name="delete" color="red" size="1.5em" />
                </q-item-side>
            </q-item>
        </q-list>
        <q-list link dense no-border>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="address.type" val="Home" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile title>Home</q-item-tile>
                </q-item-main>
            </q-item>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="address.type" val="Work" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>Work</q-item-tile>
                </q-item-main>
            </q-item>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="address.type" val="Other" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>Other</q-item-tile>
                </q-item-main>
            </q-item>
        </q-list>
        <q-input type="text" float-label="Street 1" v-model="address.street_1"></q-input>
        <q-input type="text" float-label="Street 2" v-model="address.street_2"></q-input>
        <q-input type="text" float-label="City" v-model="address.city"></q-input>
        <q-input type="text" float-label="State" v-model="address.state"></q-input>
        <q-input type="text" float-label="Zip" v-model="address.zip"></q-input>
        <q-input type="text" float-label="County" v-model="address.county"></q-input>
        <q-input type="text" float-label="Country" v-model="address.country"></q-input>
        <div class="row justify-end">
            <template v-if="address.edit !== null">
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
				address: {
					type: 'Home',
					street_1: null,
					street_2: null,
					city: null,
					state: null,
					zip: null,
					county: null,
					country: null,
                    edit: null,
                }
            }
        },
        props: ['addresses'],
		methods: {
			add () {
				this.$store.commit('addAddress', {address: Object.assign({}, this.address)});
				this.reset();
			},
			edit (index) {
				let address = this.addresses[index];
				for(let key in address) {
					this.address[key] = address[key];
				}
				this.address.edit = index;
				this.$store.commit('editAddress', {index, address: Object.assign({}, this.address)});
			},
			save () {
				this.$store.commit('editAddress', {index: this.address.edit, address: Object.assign({}, this.address)});
				this.reset();
			},
			destroy (index) {
				this.$store.commit('deleteAddress', {index});
			},
			reset () {
				for(let key in this.address) {
					if(key === 'type') {
						this.address[key] = 'Home';
                    } else {
						this.address[key] = null;
                    }
                }
			}
		}
	};
</script>