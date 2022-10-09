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

		<!-- categories table -->
		<div class="flex flex-col p-4">
			<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-brandColor">
								<tr>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S/N</th>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User name</th>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Phone</th>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel Owner name</th>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel Id</th>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">trx_id</th>
									<th scope="col" class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<tr v-for="(book, index) in bookHostels" :key="index">
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div class="ml-4">
												<div class="text-sm font-medium text-gray-900">
													{{ index + 1 }}
												</div>
											</div>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="font-bold text-gray-900">
											{{ book.user.name }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="font-bold text-gray-900">
											{{ book.user.phone }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="font-bold text-gray-900">
											{{ book.hostel.owner }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="font-bold text-gray-900">
											{{ book.hostel.id }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="font-bold text-gray-900">
											{{ book.created_at }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex justify-start items-center space-x-2">
											<button type="button" @click="edit(book.id)">
												<PencilAltIcon class="h-6 text-green-500" />
											</button>
											<button type="button" @click="openModel(book.id)">
												<TrashIcon class="h-6 text-red-500" />
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end categories table -->

		<TransitionRoot as="template" :show="open">
			<Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="open = false" :open="open">
				<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
						<DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
					</TransitionChild>

					<!-- This element is to trick the browser into centering the modal contents. -->
					<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
							<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
								<div class="sm:flex sm:items-start">
									<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
										<ExclamationIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
									</div>
									<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
										<DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Delete Category?</DialogTitle>
										<div class="mt-2">
											<p class="text-sm text-gray-500">Are you sure you want to delete this category? All of your data will be permanently removed. This action cannot be undone.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="deleteLocation()">Delete</button>
								<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancel</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</Dialog>
		</TransitionRoot>
		<!--     model end     -->

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
		bookHostels: Object,
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
