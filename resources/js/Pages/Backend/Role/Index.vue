<template>
	<Head>
		<title>Roles {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout title="Dashboard">
		<div>
			<div>
				<Breadcrumb
					:links="[
						{title: 'Dashboard', url: '/app/dashboard'},
						{title: 'Roles', url: ''},
					]"
				/>
			</div>
			<div class="mx-auto">
				<div class="flex flex-col lg:flex-row justify-between lg:items-center my-2 lg:my-4">
					<div class="flex-1 order-2 lg:order-1">
						<input class="w-full lg:w-96 h-8 lg:h-10 rounded-md text-sm py-2 px-4 border border-gray-300 focus:outline-none focus:border-transparent" v-model="filters.search" type="text" name="search" placeholder="Search Role" />
					</div>
					<div class="mb-2 lg:mb-0 ml-auto order-1 lg:order-2">
						<div class="flex gap-x-2">
							<Link :href="route('app.roles.create')" class="h-8 lg:h-10 inline-flex items-center px-3 lg:px-4 py-2 bg-orange-600 hover:bg-orange-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark active:bg-dark focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150"><PlusIcon class="h-4 w-4 mr-2" aria-hidden="true" /> Create </Link>
						</div>
					</div>
				</div>

				<!-- Activity table (small breakpoint and up) -->
				<div class="container mx-auto">
					<div class="flex flex-col mt-2">
						<div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden rounded-md sm:rounded-lg">
							<table class="min-w-full divide-y divide-gray-200">
								<thead>
									<tr>
										<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
										<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
										<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
										<th class="px-3 py-2 lg:px-6 lg:py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									<tr v-for="(role, index) in roles.data" :key="index" class="bg-white">
										<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
											{{ index + 1 }}
										</td>
										<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
											{{ role.name }}
										</td>
										<td class="px-3 py-2 lg:px-6 lg:py-3 whitespace-nowrap text-sm text-gray-900">
											<span v-if="role.permissions.length == 0" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white"> No Permission Found </span>
											<span v-else-if="role.permissions.length !== 0" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
												{{ role.permissions.length }}
											</span>
										</td>
										<td class="px-3 py-2 lg:px-6 lg:py-3 text-right whitespace-nowrap text-sm text-gray-900">
											<div class="flex justify-end space-x-2 text-right">
												<Link :href="route('app.roles.edit', role.slug)">
													<PencilAltIcon class="h-5 w-5 text-primary" />
												</Link>
												<button @click="openModel(role.id)">
													<TrashIcon class="h-5 w-5 text-red-500" />
												</button>
											</div>
										</td>
									</tr>

									<!-- More transactions. -->
								</tbody>
							</table>
						</div>
						<!-- Pagination -->
						<div v-if="roles.data.length>9">
							<Pagination :links="roles.links" :to="roles.to" :from="roles.from" :total="roles.total" />
						</div>
						<!-- End Pagination -->
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<TransitionRoot as="template" :show="open">
			<Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="open = false" :open="open">
				<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
						<DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
					</TransitionChild>

					<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
							<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
								<div class="sm:flex sm:items-start">
									<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
										<ExclamationIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
									</div>
									<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
										<DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Delete Role?</DialogTitle>
										<div class="mt-2">
											<p class="text-sm text-gray-500">Are you sure you want to delete the role? All of your data will be permanently removed. This action cannot be undone.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="deleteRole()">Delete</button>
								<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false" ref="cancelButtonRef">Cancel</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</Dialog>
		</TransitionRoot>
		<!--End Modal -->
	</app-layout>
</template>

<script>
import {defineComponent, ref, reactive, watch} from "vue"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import Breadcrumb from "@/Components/Breadcrumb.vue"
import {Link, Head} from "@inertiajs/inertia-vue3"
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue"
import {PencilAltIcon, TrashIcon, ExclamationIcon, PlusIcon} from "@heroicons/vue/outline"
import {Inertia} from "@inertiajs/inertia"
import Pagination from "@/Components/Pagination.vue"

export default defineComponent({
	components: {
		AppLayout,
		Link,
		PencilAltIcon,
		TrashIcon,
		Dialog,
		DialogOverlay,
		DialogTitle,
		TransitionChild,
		TransitionRoot,
		ExclamationIcon,
		Pagination,
		Head,
		Breadcrumb,
		PlusIcon,
	},
	props: {
		roles: Object,
		queries: Object,
	},
	setup(props) {
		const open = ref(false)
		const role_id = ref(null)
		function openModel(id) {
			role_id.value = id
			open.value = true
		}

		function deleteRole() {
			Inertia.delete(`/app/roles/${role_id.value}`, {
				preserveState: true,
				preserveScroll: true,
				onSuccess: (page) => {
					open.value = false
				},
			})
		}

		const filters = reactive({
			search: props.queries.search ?? null,
		})

		const getFilter = () => {
			let obj = {}
			Object.keys(filters).forEach((key) => {
				if (filters[key]) {
					Object.defineProperty(obj, key, {
						value: filters[key],
						writable: true,
						enumerable: true,
					})
				}
			})
			return obj
		}

		watch(
			() => [filters.search],
			(newValue, oldValue) => {
				setTimeout(() => {
					Inertia.get(route("app.roles.index"), getFilter(), {
						preserveState: true,
						preserveScroll: true,
					})
				}, 500)
			}
		)

		return {
			open,
			openModel,
			deleteRole,
			filters,
		}
	},
})
</script>
