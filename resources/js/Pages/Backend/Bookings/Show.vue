<template>
	<Head>
		<title>Blog Categories {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<div class="p-6 flex justify-between items-center gap-4">
			<div class="flex items-center space-x-4 justify-between">
				<!-- Breadcumb  -->
				<Breadcrumb
					:links="[
						{title: 'Dashboard', url: '/app/dashboard'},
						{title: 'BookHostel', url: ''},
					]"
				/>
				<!-- Breadcumb  End-->
			</div>
		</div>

		 <section class="bg-white py-5">
                <div class="my-10 max-w-7xl px-4 md:px-12 mx-auto flex flex-col justify-center items-center">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-xl  pb-3 px-4">Hostel Details Page</h3>
                    <h1 class="playfair_custom font-medium text-2xl px-4 text-center"></h1>


                    <div class="grid grid-cols-12 gap-6 py-12">
                        <!-- left content  -->
                        <div class="col-span-12 md:col-span-6">
                            <div class="h-full w-full">
                                <img :src="`/storage/`+hostel.thumbnail" alt="thumbnail" class="h-2/3 w-full rounded-lg">

                                <div class="mt-8">
                                    <Link :href="route('app.book.approve',hostel.id)">
                                        <button class="px-12 py-2 bg-green-600 text-white font-bold rounded-full">
                                          Approve
                                        </button>
                                    </Link>

                                    <Link :href="route('app.book.cancel',hostel.id)">
                                        <button class="ml-4 px-12 py-2 bg-red-600 text-white font-bold rounded-full">
                                          Cancel
                                        </button>
                                    </Link>
                                </div>
                            </div>
                            
                        </div>
                        <!-- right content  -->
                        <div class="col-span-12 md:col-span-6">
                            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Room Information</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All the Details and Specification.</p>
                                </div>
                                <div class="border-t border-gray-200">
                                    <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">User Name</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.user.name}}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">User Phone number</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.user.phone}}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">User address</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.address}}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Hostel Id </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.hostel.id}}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Hostel Owner</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.hostel.owner}}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Hostel owner number</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.hostel.owner_num}}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Hostel address</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.hostel.address}} Roomate</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Hostel Rent</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.hostel.rent }} BDT</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Advance booking</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.advance}} BDT</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Transaction ID</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.trx_id }}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            <p v-if="hostel.status == 0" class="px-6 text-white rounded-full text-sm py-1 bg-cyan-600">Processing</p>
                                            <p v-if="hostel.status == 1" class="px-6 text-white rounded-full text-sm py-1 bg-green-600">Confirm</p>
                                            <p v-if="hostel.status == 2" class="px-6 text-white rounded-full text-sm py-1 bg-red-600">Rejected/Cancel Booking</p>
                                        </dd>
                                    </div>
                                   
                                    </dl>
                                </div>
                                </div>

                        </div>
                    </div>
                </div>
            </section>

	

		<!-- Pagination -->
		<!-- <div v-if="categories.data.length>9">
			<Pagination :links="categories.links" :to="categories.to" :from="categories.from" :total="categories.total" />
		</div> -->
		<!-- End Pagination -->
	</app-layout>
</template>

<script>
import {ref} from "@vue/reactivity"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import {PlusIcon} from "@heroicons/vue/outline"
import Pagination from "@/Components/Pagination.vue"
import Breadcrumb from "@/Components/Breadcrumb.vue"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon} from "@heroicons/vue/solid"
import {HomeIcon} from "@heroicons/vue/solid"
import {Head, Link} from "@inertiajs/inertia-vue3"
const pages = [
	{name: "Home", href: "/app/dashboard", current: false},
	{name: "Category", href: "#", current: true},
]
import {Inertia} from "@inertiajs/inertia"
import {UserGroupIcon, MenuIcon, BanIcon, BadgeCheckIcon, EyeIcon, QuestionMarkCircleIcon, CollectionIcon, TrashIcon, ExclamationIcon, PencilAltIcon} from "@heroicons/vue/outline"
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue"
export default {
	components: {
		AppLayout,
		PlusIcon,
		Pagination,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		DotsVerticalIcon,
		MenuIcon,
		UserGroupIcon,
		BanIcon,
		BadgeCheckIcon,
		EyeIcon,
		QuestionMarkCircleIcon,
		CollectionIcon,
		TrashIcon,
		Dialog,
		DialogOverlay,
		DialogTitle,
		TransitionChild,
		TransitionRoot,
		ExclamationIcon,
		PencilAltIcon,
		HomeIcon,
		Breadcrumb,
		Head,
		Link,
	},
	props: {
		hostel: Object,
	},
	setup() {
		const open = ref(false)
		const location_id = ref(null)
		function openModel(id) {
			location_id.value = id
			open.value = true
		}
		function edit(id) {
			Inertia.get(route("app.blog-categories.edit", id))
		}
		function deleteLocation() {
			Inertia.delete(route("app.hostels.destroy", location_id.value), {
				preserveState: true,
				preserveScroll: true,
				onSuccess: (page) => {
					open.value = false
				},
			})
		}
		return {
			open,
			openModel,
			edit,
			deleteLocation,
			pages,
		}
	},
}
</script>
