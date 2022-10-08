<template>
	<Head>
		<title>Blog Create {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<div>
			<Breadcrumb
				:links="[
					{title: 'Dashboard', url: '/app/dashboard'},
					{title: 'Blogs', url: '/app/blogs'},
					{title: 'Create', url: '#'},
				]"
			/>
			<div class="bg-white rounded-md shadow overflow-hidden max-w-2xl mx-auto px-4 py-5">
				<form @submit.prevent="submit">
					<div>
						<label for="email" class="block text-sm font-medium text-gray-700">Title</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="title" id="title" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Blog Title" aria-invalid="true" aria-describedby="email-error" v-model="form.title" />
						</div>
						<span v-if="form.errors.title" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.title }}</span>
					</div>
					<!-- <div>
						<label for="email" class="block text-sm font-medium text-gray-700 pt-4">Description</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<textarea type="text" class="block w-full pr-10 sm:text-sm rounded-md" rows="4" placeholder="Blog Description" aria-invalid="true" aria-describedby="email-error" v-model="form.description" />
						</div>
						<span v-if="form.errors.description" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.description }}</span>
					</div> -->
					<div>
						<label for="email" class="block text-sm font-medium text-gray-700 pt-4">Category</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<select id="category" name="category_id" v-model="form.category_id" autocomplete="category" class="block w-full pr-10 sm:text-sm rounded-md">
								<option value="">SELECT CATEGORY</option>
								<option v-for="(category, index) in categories" :key="index" :value="category.id">
									{{ category.name }}
								</option>
							</select>
						</div>
						<span v-if="form.errors.category_id" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.category_id }}</span>
					</div>

					<div class="mt-4">
						<label for="author" class="block text-sm font-medium text-gray-700">Title</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="author" id="author" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Author Name" aria-invalid="true" aria-describedby="email-error" v-model="form.author" />
						</div>
						<span v-if="form.errors.author" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.author }}</span>
					</div>

					<!-- Thumbnail -->
					<Images v-model:thumbnail="form.thumbnail" v-model:images="form.images" :thumbnail_error="form.errors.thumbnail" :thumbnail_link="''" :images_link="[]" :images_error="form.errors.images"> </Images>
					<!-- Description field one -->
					<div class="relative border mt-8 border-gray-200 rounded-sm">
						<label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Description Field One</label>

						<div class="relative p-4">
							<!-- test richtext -->
							<textarea type="text" class="block w-full pr-10 sm:text-sm rounded-md" rows="4" placeholder="Blog Description" aria-invalid="true" aria-describedby="email-error" v-model="form.description_field_one" />
							<!-- End  test richtext-->
						</div>
					</div>
					<span v-if="form.errors.description_field_one" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.description_field_one }}</span>
					<!-- Description field two -->
					<div class="relative border mt-8 border-gray-200 rounded-sm">
						<label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Description Field Two</label>

						<div class="relative p-4">
							<!-- test richtext -->
							<textarea type="text" class="block w-full pr-10 sm:text-sm rounded-md" rows="4" placeholder="Blog Description" aria-invalid="true" aria-describedby="email-error" v-model="form.description_field_two" />
							<!-- End  test richtext-->
						</div>
					</div>
					<span v-if="form.errors.description_field_two" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.description_field_two }}</span>
					<!-- Description field three -->
					<div class="relative border mt-8 border-gray-200 rounded-sm">
						<label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Description Field Three</label>

						<div class="relative p-4">
							<!-- test richtext -->
							<textarea type="text" class="block w-full pr-10 sm:text-sm rounded-md" rows="4" placeholder="Blog Description" aria-invalid="true" aria-describedby="email-error" v-model="form.description_field_three" />
							<!-- End  test richtext-->
						</div>
					</div>
					<span v-if="form.errors.description_field_three" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.description_field_three }}</span>
					<!-- Description field four -->
					<div class="relative border mt-8 border-gray-200 rounded-sm">
						<label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Description Field Four</label>

						<div class="relative p-4">
							<!-- test richtext -->
							<textarea type="text" class="block w-full pr-10 sm:text-sm rounded-md" rows="4" placeholder="Blog Description" aria-invalid="true" aria-describedby="email-error" v-model="form.description_field_four" />
							<!-- End  test richtext-->
						</div>
					</div>
					<span v-if="form.errors.description_field_four" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.description_field_four }}</span>
					<div class="relative border mt-8 border-gray-200 rounded-sm">
						<label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Video Link</label>
						<div class="relative p-4">
							<input type="text" name="link" id="link" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Video link" aria-invalid="true" aria-describedby="email-error" v-model="form.link" />
						</div>
						<span v-if="form.errors.link" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.link }}</span>
					</div>
					<div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
						<div class="flex items-center justify-end gap-4">
							<SecondaryButton :href="route('app.blogs.index')">Cancel</SecondaryButton>
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
import Breadcrumb from "@/Components/Breadcrumb.vue"
import {PlusIcon} from "@heroicons/vue/outline"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon} from "@heroicons/vue/solid"
import {useForm, Head} from "@inertiajs/inertia-vue3"
import {ref} from "vue"
import Images from "./Components/Images"
import {QuillEditor} from "@vueup/vue-quill"
import "@vueup/vue-quill/dist/vue-quill.snow.css"
import "@vueup/vue-quill/dist/vue-quill.bubble.css"
export default {
	components: {
		AppLayout,
		PlusIcon,
		PrimaryButton,
		SecondaryButton,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		DotsVerticalIcon,
		Images,
		QuillEditor,
		Head,
		Breadcrumb,
	},
	props: {
		categories: Array,
	},
	setup() {
		const image = ref(null)
		const form = useForm({
			title: null,
			author: null,
			description_field_one: null,
			description_field_two: null,
			description_field_three: null,
			description_field_four: null,
			link: null,
			category_id: "",
			thumbnail: null,
			images: [],
		})
		const thumbnail = ref(null)
		function thumbnailPreview(file) {
			const reader = new FileReader()
			reader.onload = (e) => {
				thumbnail.value = e.target.result
			}
			reader.readAsDataURL(file)
		}
		function submit() {
			form.post(route("app.blogs.store"), {
				onSuccess: () => {
					form.reset("title", "description", "category_id")
				},
			})
		}

		return {
			form,
			submit,
			thumbnail,
			thumbnailPreview,
		}
	},
}
</script>
