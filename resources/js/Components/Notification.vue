<template>
	<!--    Notification    -->
	<div v-if="$page.props.flash.success" class="bg-green-500 px-3 py-2 w-80 shadow rounded-md fixed z-[60] top-3 transition-all duration-500" :class="show ? 'right-3 opacity-100' : '-right-80 opacity-0'">
		<!-- top message -->
		<div class="flex items-center">
			<div class="w-7 text-white mr-3">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			</div>
			<p class="text-white text-lg font-semibold">{{ message }}</p>
			<div class="w-5 text-white hover:text-gray-800 ml-auto cursor-pointer" @click="show = false">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</div>
		</div>
	</div>
	<div v-if="$page.props.flash.error" class="bg-red-500 px-3 py-2 w-80 shadow rounded-md fixed z-[60] top-3 transition-all duration-500" :class="show ? 'right-3 opacity-100' : '-right-80 opacity-0'">
		<!-- top message -->
		<div class="flex items-center">
			<div class="w-7 text-white mr-3">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			</div>
			<p class="text-white text-lg font-semibold">{{ message }}</p>
			<div class="w-5 text-white hover:text-gray-800 ml-auto cursor-pointer" @click="show = false">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			show: false,
			type: null,
			message: null,
		}
	},
	watch: {
		"$page.props.flash": {
			handler() {
				this.showNotifications()
			},
			deep: true,
		},
	},
	created() {
		// console.log("ami ekhane")
		this.showNotifications()
	},
	methods: {
		showNotifications() {
			if (this.$page.props.flash.success) {
				this.notify("success", this.$page.props.flash.success)
			}
			if (this.$page.props.flash.error) {
				this.notify("error", this.$page.props.flash.error)
			}
		},
		notify(type, message) {
			this.type = type
			this.message = message
			this.show = true
			setTimeout(() => {
				this.show = false
			}, 4000)
		},
	},
}
</script>
