<template>
	<Head>
		<title>Shippings {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<div class="p-6 flex justify-between items-center gap-4">
			<div class="flex items-center space-x-4 justify-between">
				<Breadcrumb
					:links="[
						{title: 'Dashboard', url: '/app/dashboard'},
						{title: 'Notice', url: ''},
					]"
				/>
			</div>
			<div class="mt-5 sm:mt-0 sm:flex-shrink-0 sm:flex sm:items-center sm:justify-center">
				<button @click="openModal()" class="h-8 lg:h-10 inline-flex items-center px-3 lg:px-4 py-2 bg-orange-600 hover:bg-orange-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark active:bg-dark focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150 float-right"><PlusIcon class="h-4 w-4 mr-2" aria-hidden="true" />Add Notice</button>
			</div>
		</div>
		<div class="flex flex-col p-4">
			<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-brandColor">
								<tr class="bg-gray-100">
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
									<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Action</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<tr v-for="(row, index) in notices.data" :key="index">
									<td class="px-6 py-4 whitespace-nowrap">{{ index + 1 }}</td>
									<td class="px-6 py-4 whitespace-nowrap">{{ row.notice }}</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<!-- Status Button -->
										<div @click="statusEvent(row)" class="inline-block">
											<Switch v-model="row.enabled" class="flex-shrink-0 group relative rounded-full inline-flex items-center justify-center h-5 w-10 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700 text-green-700">
												<span class="sr-only">Use setting</span>
												<span aria-hidden="true" class="pointer-events-none absolute bg-white w-full h-full rounded-md" />
												<span aria-hidden="true" :class="[row.enabled ? 'bg-green-700' : 'bg-gray-200', 'pointer-events-none absolute h-4 w-9 mx-auto rounded-full transition-colors ease-in-out duration-200']" />
												<span aria-hidden="true" :class="[row.enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none absolute left-0 inline-block h-5 w-5 border border-gray-200 rounded-full bg-white shadow transform ring-0 transition-transform ease-in-out duration-200']" />
											</Switch>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap ">{{ row.created_at }}</td>	
									<td class="px-6 py-4 whitespace-nowrap text-center">
										<button type="button" @click="edit(row)">
											<PencilAltIcon class="h-6 text-green-500" />
										</button>
										<button type="button" @click="openModel(row.id)">
											<TrashIcon class="h-6 text-red-500" />
										</button>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
							<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
								<div class="fixed inset-0 transition-opacity">
									<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
								</div>
								<!-- This element is to trick the browser into centering the modal contents. -->
								<span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
								<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
									<form>
										<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
											<div class="">
												<div class="mb-4">
													<label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Notice</label>
													<input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.notice" />
													<!-- <div v-if="$page.errors.title" class="text-red-500">{{ $page.errors.title[0] }}</div> -->
												</div>
												
												
											</div>
										</div>
										<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
											<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
												<button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">Save</button>
											</span>
											<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
												<button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">Update</button>
											</span>
											<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
												<button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">Cancel</button>
											</span>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
										<DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Delete Shipping Method?</DialogTitle>
										<div class="mt-2">
											<p class="text-sm text-gray-500">Are you sure you want to delete this shipping method? All of your data will be permanently removed. This action cannot be undone.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="deleteNotice()">Delete</button>
								<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancel</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</Dialog>
		</TransitionRoot>
		<!--     model end     -->
		<!-- pagination -->
		<!-- <div v-if="shippings.data.length>9">
		<Pagination :links="shippings.links" :to="shippings.to" :total="shippings.total" />

		</div> -->
	</app-layout>
</template>

<script>
import {ref} from "vue"
import {Inertia} from "@inertiajs/inertia"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import Breadcrumb from "@/Components/Breadcrumb.vue"
import Pagination from "@/Components/Pagination.vue"
import ModalConfirm from "@/Components/ModalConfirm.vue"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon} from "@heroicons/vue/solid"
import {Head} from "@inertiajs/inertia-vue3"
import {Switch} from "@headlessui/vue"
import {TrashIcon, PencilAltIcon, PlusIcon, ExclamationIcon} from "@heroicons/vue/outline"
export default {
	components: {
		Switch,
		AppLayout,
		PlusIcon,
		Pagination,
		ModalConfirm,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		DotsVerticalIcon,
		PencilAltIcon,
		TrashIcon,
		Breadcrumb,
		ExclamationIcon,
		Head,
	},
	// props: ['data', 'errors'],
	props: {
		notices: Object,
	},
	data() {
		return {
			color: "#59c7f9",
			suckerCanvas: null,
			suckerArea: [],
			isSucking: false,
			editMode: false,
			isOpen: false,
			form: {
				notice: null,
				enabled: 0,
			},
			hex: this.color,
			open: ref(false),
			shipping_id: ref(null),
		}
		///console.log(this.color);     //ekhane updated color pacche
	},
	methods: {
		statusEvent: function (row) {
			console.log(row.enabled);

			this.$inertia.post(
				route("app.notice.status", row.id),
				{
					status: row.enabled,
				},
				{
					preserveState: true,
					preserveScroll: true,
				}
			)
		},
		openModal: function () {
			this.isOpen = true
		},
		closeModal: function () {
			this.isOpen = false
			this.reset()
			this.editMode = false
		},
		reset: function () {
			this.form = {
				title: null,
				cost: null,
				description: null,
				enabled: 0,
			}
		},
		save: function (data) {
			// this.closeModal()
			this.$inertia
				.post(route("app.notice.store"), data, {
					replace: false,
					preserveState: true,
					preserveScroll: true,
					onSuccess: () => {
						if (Object.keys(this.$page.props.errors).length === 0) {
							// this.dialog.value = false;
							this.reset()
							this.closeModal()
							this.editMode = false
							this.loading = true
							data.id = null
							data.title = null
						} else {
							// this.dialog.value = true;
						}
						this.loading = false
						}
				})
		},
		edit: function (data) {
			this.form = Object.assign({}, data)
			this.editMode = true
			this.openModal()
		},
		update: function (data) {
			data._method = "PUT"
			this.$inertia.post(route("app.notice.update", data.id), data)
			this.reset()
			this.closeModal()
		},
		openModel: function (id) {
			this.notice_id = id
			this.open = true
		},
		deleteNotice: function () {
			Inertia.delete(route("app.notice.destroy", this.notice_id), {
				preserveState: true,
				preserveScroll: true,
				onSuccess: (page) => {
					this.open = false
				},
			})
		},
		getAttribute() {
			return this.shippings.find((d) => d.slug === this.form.type)
		},
	},
}
</script>
style
<style scoped>
.float-container {
	border: 3px solid #fff;
	padding: 5px;
}

.float-child {
	width: 50%;
	float: left;
	padding: 2px;
}
</style>
