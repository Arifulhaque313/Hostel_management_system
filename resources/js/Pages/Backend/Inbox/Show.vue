<template>
	<Head>
		<title>Message Show {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<section class="p-4 bg-gray-100">
			<div class="mx-auto my-2">
				<h1 class="text-center text-xl font-bold text-gray-700">{{ $page.props.flash.success }}</h1>
				<div class="flex items-center space-x-4 justify-between">
					<Breadcrumb
						:links="[
							{title: 'Dashboard', url: '/app/dashboard'},
							{title: 'All Messages', url: '/app/inbox'},
							{title: 'Message Show', url: '#'},
						]"
					/>
				</div>
				<div class="bg-white shadow overflow-hidden sm:rounded-lg my-10 pb-10">
					<div class="flex justify-between items-center w-full">
						<div class="px-4 py-5 sm:px-6">
							<h3 class="text-lg leading-6 font-medium text-gray-900">Message Information</h3>
							<p class="mt-1 text-sm text-gray-500">Message details of {{ contact.name }}</p>
						</div>
						<div class="mr-4">
							<h2>Message Received at: {{ contact.created_at }}</h2>
						</div>
					</div>
					<div class="border-t border-gray-200 px-4 py-5 sm:p-0">
						<dl class="sm:divide-y sm:divide-gray-200">
							<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">Full name</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ contact.name }}</dd>
							</div>
							<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">Email</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ contact.email }}</dd>
							</div>
							<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">Subject</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ contact.subject }}</dd>
							</div>
							<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 break-words">
								<dt class="text-sm font-medium text-gray-500">Location</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ contact.location }}</dd>
							</div>
							<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 break-words">
								<dt class="text-sm font-medium text-gray-500">Message</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ contact.message }}</dd>
							</div>
						</dl>
					</div>
				</div>
				<!-- Information table -->

				<!-- Information table End-->
				<!-- Pagination -->
				<!-- <Paginate :links="admissions.links" /> -->
				<!-- Pagination End-->
			</div>
		</section>
	</app-layout>
</template>

<script>
import {ref, onMounted, onBeforeMount, computed} from "@vue/reactivity"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import {PlusIcon} from "@heroicons/vue/outline"
import Pagination from "@/Components/Pagination.vue"
import ModalConfirm from "@/Components/ModalConfirm.vue"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon} from "@heroicons/vue/solid"
import {HomeIcon} from "@heroicons/vue/solid"
import Breadcrumb from "@/Components/Breadcrumb.vue"
import {useForm, Head} from "@inertiajs/inertia-vue3"
import {Inertia} from "@inertiajs/inertia"
import {UserGroupIcon, MenuIcon, BanIcon, BadgeCheckIcon, EyeIcon, QuestionMarkCircleIcon, CollectionIcon, TrashIcon, ExclamationIcon, PencilAltIcon} from "@heroicons/vue/outline"
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue"
export default {
	components: {
		AppLayout,
		PlusIcon,
		Pagination,
		ModalConfirm,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		DotsVerticalIcon,
		AppLayout,
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
		Head,
		Breadcrumb,
	},
	props: {
		contact: Object,
	},
}
</script>
