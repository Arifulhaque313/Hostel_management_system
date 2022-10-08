<template>
	<Head title="Dashboard" />
	<app-layout title="Dashboard">
		<div class="max-w-7xl mx-auto flex flex-col justify-center items-center px-4 sm:px-6 md:px-8 mt-20">
			<div class="flex">
				<!-- <img class="h-24 w-auto mx-auto" src="/images/init/logo.png" alt="" /> -->
			</div>
			<h2 class="text-xl md:text-3xl text-center pt-6 font-semibold text-pink-600">Welcome to Hostel Lagbe Dashboard</h2>
		</div>
	</app-layout>
</template>

<script>
import {defineComponent} from "vue"
import AppLayout from "../../Layouts/Backend/AppLayout.vue"
import {Head} from "@inertiajs/inertia-vue3"

export default defineComponent({
	data() {
		return {
			data: [],
		}
	},
	components: {
		AppLayout,
		Head,
	},
})
</script>
