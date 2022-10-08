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
					{title: 'Hostel', url: '/app/hostels'},
					{title: 'Create', url: '#'},
				]"
			/>
			<div class="bg-white rounded-md shadow overflow-hidden max-w-2xl mx-auto px-4 py-5">
				<form @submit.prevent="submit">
					<div>
						<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="title" id="title" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Tolet Title" aria-invalid="true" aria-describedby="email-error" v-model="form.title" />
						</div>
						<span v-if="form.errors.title" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.title }}</span>
					</div>

					<div class="mt-4">
						<label for="info" class="block text-sm font-medium text-gray-700">Owner Name</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="title" id="info" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Owner Name" aria-invalid="true" aria-describedby="email-error" v-model="form.owner" />
						</div>
						<span v-if="form.errors.owner" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.owner }}</span>
					</div>

					<div class="mt-4">
						<label for="info" class="block text-sm font-medium text-gray-700">Owner Number</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="title" id="info" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Owner Number" aria-invalid="true" aria-describedby="email-error" v-model="form.owner_num" />
						</div>
						<span v-if="form.errors.owner_num" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.owner_num }}</span>
					</div>

					<div class="mt-4">
						<label for="info" class="block text-sm font-medium text-gray-700">Hostel Type</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<select id="type" name="type" v-model="form.type" autocomplete="type" class="block w-full pr-10 sm:text-sm rounded-md">
								<option value="">select type</option>
								<option value="single">Single</option>
								<option value="bachelor">Bachelor</option>
							</select>
						</div>
						<span v-if="form.errors.type" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.type }}</span>
					</div>

					<div class="mt-4">
						<label for="info" class="block text-sm font-medium text-gray-700">If Bachelor (How many person)</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="title" id="info" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="How many person" aria-invalid="true" aria-describedby="email-error" v-model="form.person" />
						</div>
						<span v-if="form.errors.person" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.person }}</span>
					</div>
				
					<div class="mt-4">
						<label for="email" class="block text-sm font-medium text-gray-700">Area</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<select id="area" name="area" v-model="form.area" autocomplete="category" class="block w-full pr-10 sm:text-sm rounded-md">
								<option value="">select area</option>
								<option value="dhaka">Dhaka</option>
								<option value="Uttora">Uttora</option>
								<option value="dhanmondi">Dhanmondi</option>
								<option value="panthpath">Panthpath</option>
								<option value="mirpur">Mirpur</option>
								<option value="shabug">Shabug</option>
								<option value="firmgate">Shabug</option>
								
							</select>
						</div>
						<span v-if="form.errors.area" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.area }}</span>
					</div>

					<div class="mt-4">
						<label for="author" class="block text-sm font-medium text-gray-700">Full Address</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="address" id="address" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Author Name" aria-invalid="true" aria-describedby="email-error" v-model="form.address" />
						</div>
						<span v-if="form.errors.address" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.address }}</span>
					</div>

					<div class="mt-4">
						<label for="author" class="block text-sm font-medium text-gray-700">Rent per month</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<input type="text" name="rent" id="rent" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="Rent per month" aria-invalid="true" aria-describedby="email-error" v-model="form.rent" />
						</div>
						<span v-if="form.errors.rent" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.rent }}</span>
					</div>

					<div class="mt-4">
						<label for="author" class="block text-sm font-medium text-gray-700">Short Description</label>
						<div class="mt-1 relative rounded-md shadow-sm">
							<textarea v-model="form.description" name="" id="" cols="30" rows="4" class="block w-full pr-10 sm:text-sm rounded-md"></textarea>
						</div>
						<!-- <span v-if="form.errors.rent" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.rent }}</span> -->
					</div>


					<div class="mt-8 relative flex items-center border border-gray-200 rounded-sm">
						<label class="absolute -top-4 z-10 font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Thumbnail Image</label>
						<input @input="form.thumbnail = $event.target.files[0]" @change="upload_thumbnail" id="file-upload" name="file-upload" type="file" class="pt-6 relative max-w-lg block w-full h-20 font-semibold px-4 sm:max-w-full sm:text-base required text-gray-500 focus:outline-none" />
						<img v-if="get_thumbnail()" class="h-32 w-40 m-3 p-3" :src="get_thumbnail()" alt="Thumbnail" />
					</div>
					<span v-if="form.errors.thumbnail" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.thumbnail }}</span>
				
					<div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
						<div class="flex items-center justify-end gap-4">
							<SecondaryButton :href="route('app.hostels.index')">Cancel</SecondaryButton>
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
import {QuillEditor} from "@vueup/vue-quill"
import "@vueup/vue-quill/dist/vue-quill.snow.css"
import "@vueup/vue-quill/dist/vue-quill.bubble.css"
export default {
    name:'PostCreate',
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
		QuillEditor,
		Head,
		Breadcrumb,
	},
	props: {
	},
	setup() {
		const form = useForm({
			title: null,
			owner: null,
			owner_num: null,
			type: null,
			person: null,
			area: null,
			address: null,
			rent: null,
			thumbnail: null,
			description: null,
			
		})
		const thumbnail = ref(null)
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
		function submit() {
			form.post(route("app.hostels.store"), {
				// onSuccess: () => {
				// 	form.reset("title", "description", "category_id")
				// },
			})
		}

		return {
			form,
			submit,
			thumbnail,
			// thumbnailPreview,
			get_thumbnail,
			upload_thumbnail
		}
	},
}
</script>
