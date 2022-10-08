<template>
	<Head>
		<title>Blog Category Create {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<Breadcrumb
			:links="[
				{title: 'Dashboard', url: '/app/dashboard'},
				{title: 'Blogs Categories', url: '/app/blog-categories'},
				{title: 'Create', url: '#'},
			]"
		/>
		<div class="container mx-auto p-6">
			<div class="flex justify-between">
				<!-- <div class="mt-5 sm:mt-0 pl-96 sm:items-right sm:justify-right">
					<a href="/app/blog-categories" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brandColor sm:text-sm"> <ArrowCircleLeftIcon class="h-4 w-4 mr-2" aria-hidden="true" /> Back </a>
				</div> -->
			</div>

			<div class="bg-white rounded-md shadow overflow-hidden max-w-sm mx-auto px-4 py-5">
				<form @submit.prevent="submit">
					<div>
						<label for="email" class="block text-sm font-medium text-gray-700">Category name</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="name" id="name" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Category Name" aria-invalid="true" aria-describedby="email-error" v-model="form.name" />
						</div>
						<span v-if="form.errors.name" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.name }}</span>
					</div>

					<div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
						<div class="flex items-center justify-end gap-4">
							<SecondaryButton :href="route('app.blog-categories.index')">Cancel</SecondaryButton>
							<PrimaryButton :type="submit"> Save </PrimaryButton>
						</div>
					</div>
				</form>
			</div>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import {PlusIcon} from "@heroicons/vue/outline"
import Breadcrumb from "@/Components/Breadcrumb.vue"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon, ArrowCircleLeftIcon} from "@heroicons/vue/solid"
import {useForm, Head} from "@inertiajs/inertia-vue3"
import {ref} from "vue"
export default {
	components: {
		AppLayout,
		PrimaryButton,
		SecondaryButton,
		PlusIcon,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		DotsVerticalIcon,
		ArrowCircleLeftIcon,
		Breadcrumb,
		Head,
	},
	props: {
		categories: Object,
	},
	setup() {
		const thumbnail = ref(null)
		const form = useForm({
			name: null,
			thumbnail: null,
		})
		function submit() {
			form.post(route("app.blog-categories.store"), {
				onSuccess: () => {
					form.reset("name")
				},
			})
		}
		function upload_thumbnail(e) {
			let file = e.target.files[0]
			let reader = new FileReader()
			if (file["size"] < 2111775) {
				reader.onloadend = (file) => {
					thumbnail.value = reader.result
				}
				reader.readAsDataURL(file)
			} else {
				alert("File size can not be bigger than 2 MB")
			}
		}
		function get_thumbnail() {
			let photo = thumbnail.value
			return photo
		}
		function get_thumbnail() {
			// console.log(thumbnail.value)
			let photo = thumbnail.value
			return photo
		}
		return {
			form,
			submit,
			upload_thumbnail,
			get_thumbnail,
		}
	},
}
</script>
