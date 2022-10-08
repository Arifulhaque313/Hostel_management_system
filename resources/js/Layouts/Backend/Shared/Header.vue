<template>
	<div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
		<button type="button" @click="showSideBar" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
			<span class="sr-only">Open sidebar</span>
			<!-- Heroicon name: outline/menu-alt-2 -->
			<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
			</svg>
		</button>
		<div class="flex-1 px-4 flex justify-between">
			<div class="ml-auto flex items-center">
				<strong>{{ $page.props.auth.user.name }}</strong>

				<!-- Profile dropdown -->
				<div class="ml-3 relative">
					<div>
						<button @click="toggleMenu" type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false" aria-haspopup="true">
							<span class="sr-only">Open user menu</span>
							<!-- <img class="h-8 w-8 rounded-full" :src="$page.props.auth.user.image" alt="" /> -->
							<img v-if="$page.props.auth.user.image != null" class="h-8 w-8 rounded-full" :src="$page.props.auth.user.image" alt="" srcset="" />
							<img v-else class="h-8 w-8 rounded-full" src="/images/Avatar.png" alt="" srcset="" />
						</button>
					</div>

					<!--
                      Dropdown menu, show/hide based on menu state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
					<div v-if="showMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
						<!-- Active: "bg-gray-100", Not Active: "" -->
						<!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profiles</a> -->

						<Link :href="route('app.profile.show', $page.props.auth.user.id)" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</Link>

						<!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a> -->

						<Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</Link>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3"
import {reactive, ref} from "@vue/reactivity"

export default {
	name: "Header",
	components: {
		Head,
		Link,
	},
	setup(props, {emit}) {
		const showMenu = ref(false)
		const toggleMenu = () => {
			showMenu.value = !showMenu.value
		}

		const showSideBar = () => {
			emit("toggleSidebar")
			// console.log(emit, "From Emit")
		}

		return {
			showMenu,
			toggleMenu,
			showSideBar,
		}
	},
}
</script>
