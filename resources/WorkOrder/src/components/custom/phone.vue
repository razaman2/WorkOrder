<template>
    <q-collapsible icon="phone">
        <q-list v-if="phones.length" highlight>
            <q-item tag="div"  v-for="(phone, index) in phones" :key="index" @click="edit(index)">
                <q-item-side>
                    {{ phone.type }}
                </q-item-side>
                <q-item-main>
                    {{ phone.phone }}
                </q-item-main>
                <q-item-side right @click.stop="destroy(index)">
                    <q-icon name="delete" color="red" size="1.5em" />
                </q-item-side>
            </q-item>
        </q-list>
        <q-list v-if="phone.phone" link dense no-border>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="phone.type" val="Mobile" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile title>Mobile</q-item-tile>
                </q-item-main>
            </q-item>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="phone.type" val="Work" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>Work</q-item-tile>
                </q-item-main>
            </q-item>
            <q-item tag="label">
                <q-item-side>
                    <q-radio v-model="phone.type" val="Other" />
                </q-item-side>
                <q-item-main>
                    <q-item-tile label>Other</q-item-tile>
                </q-item-main>
            </q-item>
        </q-list>
        <q-input type="tel" :float-label="phone.type" v-model="phone.phone" />
        <div class="row justify-end">
            <template v-if="phone.edit !== null">
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
				phone: {
					type: 'Mobile', phone: null, edit: null,
				}
            }
        },
        props: ['phones'],
		methods: {
			add () {
				this.$store.commit('addPhone', {phone: Object.assign({}, this.phone)});
				this.reset();
			},
			edit (index) {
				let phone = this.phones[index];
				for(let key in phone) {
					this.phone[key] = phone[key];
				}
				this.phone.edit = index;
				this.$store.commit('editPhone', {index, phone: Object.assign({}, this.phone)});
			},
			save () {
				this.$store.commit('editPhone', {index: this.phone.edit, phone: Object.assign({}, this.phone)});
				this.reset();
			},
			destroy (index) {
				this.$store.commit('deletePhone', {index});
			},
			reset () {
				this.phone.type = 'Mobile';
				this.phone.phone = null;
				this.phone.edit = null;
			}
		}
	};
</script>