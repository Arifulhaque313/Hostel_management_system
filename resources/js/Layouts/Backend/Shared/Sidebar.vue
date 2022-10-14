<template>
	<aside class="h-full">
		<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
		<transition enter-active-class="transition-all duration-800 ease-in-out" enter-from-class="transform w-0 opacity-0" enter-to-class="transform w-100 opacity-100" leave-active-class="transition-all duration-40 ease-in-out" leave-from-class="transform w-100 opacity-100" leave-to-class="transform w-0 opacity-0">
			<div v-if="sidebar" class="fixed inset-0 flex z-40 md:hidden h-full" role="dialog" aria-modal="true">
				<div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
				<div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-50">
					<div class="absolute top-0 right-0 -mr-12 pt-2">
						<button @click="sidebar = false" type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
							<span class="sr-only">Close sidebar</span>
							<XIcon class="h-6 w-6 text-white" />
						</button>
					</div>

					<div class="flex-shrink-0 flex items-center px-4">
						<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow" />
					</div>
					<div class="mt-5 flex-1 h-0 overflow-y-auto">
						<nav class="px-2 space-y-1">
							<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
							<Link v-for="(menu, index) in menus" :key="index" :href="menu.path" class="text-gray-500 hover:text-primary group flex items-center px-3 py-2 text-sm font-medium rounded-full transition duration-300">
								<component :is="menu.icon" class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5"></component>
								{{ menu.name }}
							</Link>
						</nav>
					</div>
				</div>

				<div class="flex-shrink-0 w-14">
					<!-- Dummy element to force sidebar to shrink to fit close icon -->
				</div>
			</div>
		</transition>

		<!-- Static sidebar for desktop -->
		<div class="hidden md:flex md:flex-shrink-0 h-full">
			<div class="flex flex-col w-52">
				<!-- Sidebar component, swap this element with another sidebar if you like -->
				<div class="flex-1 flex flex-col min-h-0">
					<div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-50">
						<Link href="/" class="flex">
							<!-- <img class="h-8 w-auto sm:h-10" src="/images/init/logo.png" alt="" /> -->
							<p class="text-2xl font-semibold text-pink-600 italic pt-1">Hostel Lagbe</p>
						</Link>
					</div>
					<div class="flex-1 flex flex-col overflow-y-auto">
						<nav class="flex-1 px-2 py-4 bg-gray-50 space-y-1">
							<Link v-for="(menu, index) in menus" :key="index" :href="menu.path" class="text-gray-500 hover:text-primary group flex items-center px-3 py-2 text-sm font-medium rounded-full transition duration-300">
								<component :is="menu.icon" class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5"></component>
								{{ menu.name }}
							</Link>

							<!-- Settings -->
							<div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(1)">
									<UserIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1"> Users </span>
									<ChevronDownIcon :class="[showSettingsNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
								<!-- Expandable link section, show/hide based on state. -->
								<div v-if="showSettingsNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.users.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light">All Users </Link>
								</div>
							</div>

								<!-- Hostel start  -->
							<div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(13)">
									<HomeIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1">Hostel</span>
									<ChevronDownIcon :class="[showHostelNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
								<!-- Expandable link section, show/hide based on state. -->
								<div v-if="showHostelNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.hostels.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> All Hostel </Link>
								</div>
							</div>
							<!-- Hostel end  -->


							<!-- Booking start  -->
							<div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(14)">
									<DocumentAddIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1">Booking</span>
									<ChevronDownIcon :class="[showBookNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
								<!-- Expandable link section, show/hide based on state. -->
								<div v-if="showBookNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.bookings.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> All Bookings </Link>
								</div>
							</div>
							<!-- Hostel end  -->

							<!-- Blogs -->
							<div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(2)">
									<RssIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1"> Blogs </span>
									<ChevronDownIcon :class="[showBlogsNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
								<!-- Expandable link section, show/hide based on state. -->
								<div v-if="showBlogsNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.blog-categories.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> Category </Link>
									<Link :href="route('app.blogs.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> Post </Link>
								</div>
							</div>
							
							<!-- Contact Message Inbox -->
							<div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(4)">
									<ChatIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1"> Inbox </span>
									<ChevronDownIcon :class="[showMessageNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
								<!-- Expandable link section, show/hide based on state. -->
								<div v-if="showMessageNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.inbox')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> Messages </Link>
								</div>
							</div>

							

							<!-- notice start  -->
							<!-- <div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(11)">
									<InformationCircleIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1"> Notice</span>
									<ChevronDownIcon :class="[showNoticeNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
							
								<div v-if="showNoticeNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.notice.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> All Notice </Link>
								</div>
							</div> -->
							<!-- notice end  -->

							<!-- newsletter start  -->
							<!-- <div class="space-y-1">
								<button type="button" class="text-gray-500 hover:bg-light hover:text-primary group w-full flex items-center pl-3 pr-2 py-2 text-left text-sm font-medium rounded-full transition duration-300" aria-controls="sub-menu-2" aria-expanded="false" @click="toggleNavs(12)">
									<NewspaperIcon class="text-gray-500 group-hover:text-primary mr-3 flex-shrink-0 h-5 w-5" />
									<span class="flex-1"> News Letter</span>
									<ChevronDownIcon :class="[showNewsNav ? 'text-primary rotate-180' : 'text-gray-500']" class="ml-3 flex-shrink-0 h-4 w-4 transform group-hover:text-primary transition-all ease-in-out duration-500" />
								</button>
					
								<div v-if="showNewsNav" class="space-y-1 bg-gray-100 rounded-md block">
									<Link :href="route('app.newsletter.index')" class="group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-primary hover:bg-light"> All NewsLetter </Link>
								</div>
							</div> -->

							<!-- newsletter end  -->

						


						</nav>
					</div>
				</div>
			</div>
		</div>
	</aside>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3"
import {HomeIcon,UserIcon,AnnotationIcon, DocumentAddIcon,PencilAltIcon, NewspaperIcon , InformationCircleIcon ,ChatIcon, ChevronDownIcon, CogIcon, ShoppingBagIcon, RssIcon, LightBulbIcon, CollectionIcon, CameraIcon, BookOpenIcon} from "@heroicons/vue/outline"
import {ref} from "vue"
const menus = [
	{
		name: "Dashboard",
		path: "/app/dashboard",
		icon: HomeIcon,
	},
]

export default {
	name: "Sidebar",
	components: {
		Link,
		HomeIcon,
		RssIcon,
		ChevronDownIcon,
		CogIcon,
		ShoppingBagIcon,
		ChatIcon,
		LightBulbIcon,
		CollectionIcon,
		CameraIcon,
		BookOpenIcon,
		AnnotationIcon,
		PencilAltIcon,
		InformationCircleIcon,
		NewspaperIcon,
		UserIcon,
		DocumentAddIcon
	},
	props: {
		sidebar: {
			type: Boolean,
			required: true,
		},
	},
	setup(props) {
		const showSettingsNav = ref(false)
		const showBlogsNav = ref(false)
		const showMessageNav = ref(false)
		const showNoticeNav = ref(false)
		const showNewsNav = ref(false)
		const showHostelNav = ref(false)
		const showBookNav = ref(false)

		const closeSidebar = () => {
			props.sidebar = hideMobileSidebar.value
		}
		const toggleNavs = (val) => {
			showSettingsNav.value = false
			showBlogsNav.value = false
			showMessageNav.value = false
			showNoticeNav.value = false
			showNewsNav.value = false
			showHostelNav.value = false
			showBookNav.value = false
			if (val === 1) showSettingsNav.value = !showSettingsNav.value
			else if (val === 2) showBlogsNav.value = !showBlogsNav.value
			else if (val === 4) showMessageNav.value = !showMessageNav.value
			else if (val === 11) showNoticeNav.value = !showNoticeNav.value
			else if (val === 12) showNewsNav.value = !showNewsNav.value
			else if (val === 13) showHostelNav.value = !showHostelNav.value
			else if (val === 14) showBookNav.value = !showBookNav.value
		}
		return {
			closeSidebar,
			menus,
			showSettingsNav,
			toggleNavs,
			showBlogsNav,
			showMessageNav,
			showNoticeNav,
			showNewsNav,
			showHostelNav,
			showBookNav
		}
	},
}
</script>
