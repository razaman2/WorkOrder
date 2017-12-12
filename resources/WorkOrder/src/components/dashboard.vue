<template>
    <q-layout class="">

        <q-field
                icon="cloud"
                label="Your Gmail"
                helper="Helper"
                :error="false"
                error-label="We need a valid email"
                :count="30"
        >
            <q-input suffix="example@domain.com" v-model="model" />

        </q-field>
    </q-layout>
</template>

<script>
	export default {
		data () {
			return {
				model: null,
            }
        }
	}
</script>

<style scoped>
    .boxes{
        border: .1em solid grey;
        border-radius: .2em;
        padding: 10px;
        margin: 5px;
    }
</style>