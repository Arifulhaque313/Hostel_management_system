<template>
	<div class="h-screen flex overflow-hidden bg-gray-100">
		<Sidebar :sidebar="toggleMobileSidebar" />
		<div class="flex flex-col w-0 flex-1 overflow-hidden">
			<Notification />
			<Header @toggle-sidebar="toggleSidebar" />

			<main class="flex-1 relative overflow-y-auto focus:outline-none">
				<div class="container mx-auto px-3 lg:px-6 py-3 lg:py-6 h-auto">
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>

<script>
import Header from "./Shared/Header"
import Sidebar from "./Shared/Sidebar"
import Notification from "../../Components/Notification.vue"

export default {
	components: {
		Header,
		Sidebar,
		Notification,
	},
	data() {
		return {
			toggleMobileSidebar: false,
		}
	},
	methods: {
		toggleSidebar() {
			this.toggleMobileSidebar = !this.toggleMobileSidebar
		},
	},
}
</script>
