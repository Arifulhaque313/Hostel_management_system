<template>
	<Head>
		<title>Profile {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<div class="bg-white shadow px-4 pb-10 sm:rounded-lg sm:p-6">
			<div class="md:grid md:grid-cols-3 md:gap-6 py-8">
				<div class="md:col-span-1">
					<h3 class="text-2xl font-black leading-6 text-gray-900">{{ user.name }}'s Information</h3>
					<p class="mt-2 text-sm text-orange-600 hover:text-orange-700">Details of {{ user.name }}</p>
				</div>
				<div class="mt-5 md:mt-0 md:col-span-2">
					<div class="bg-gray-100 shadow overflow-hidden sm:rounded-lg">
						<div class="border-t border-gray-200 px-4 py-5 sm:p-0">
							<dl class="sm:divide-y sm:divide-gray-200">
								<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
									<dt class="text-sm font-medium text-gray-500">Profile Photo</dt>
									<input id="image" name="image" @input="form.image = $event.target.files[0]" type="file" @change="upload_image" class="w-1/2 md:w-full focus:ring-orange-500 focus:border-orange-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300 hidden" />
									<button class="bg-transparent hover:bg-orange-500 text-gray-500 hover:text-white py-1 px-1 border border-gray-300 hover:border-transparent rounded md:h-8 md:w-32">
										<label for="image">Change Photo</label>
									</button>

									<img v-if="form.image != null" :src="get_image()" alt="" class="w-1/2 md:w-full md:h-full inline-block" />
									<img v-else :src="user.image" alt="" class="w-1/2 md:w-full md:h-full inline-block" />

									<!-- <img :src="user.image=='' ? get_image():user.image" alt="profile photo" class="h-32 w-40 m-3 p-3"> -->
								</div>
								<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
									<label for="confirm_password" class="text-sm font-medium text-gray-500 mt-4"> User Name </label>
									<div class="mt-1 flex rounded-md shadow-sm">
										<input type="text" name="name" v-model="form.name" id="name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="" />
									</div>
								</div>

								<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
									<dt class="text-sm font-medium text-gray-500">User's Role</dt>
									<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
										{{ user.role.name }}
									</dd>
								</div>

								<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
									<label for="confirm_password" class="text-sm font-medium text-gray-500 mt-4"> Phone </label>
									<div class="mt-1 flex rounded-md shadow-sm">
										<input type="text" name="phone" v-model="form.phone" id="phone" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="" />
									</div>
								</div>

								<!-- <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
									<dt class="text-sm font-medium text-gray-500">Status</dt>
									<dd>
										<span v-if="user.status == 1" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white"> Active </span>
										<span v-else-if="user.status == 0" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white"> Inactive </span>
									</dd>
								</div> -->

								<form @submit.prevent="submit">
									<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
										<label for="password" class="text-sm font-medium text-gray-500 mt-4"> Password </label>
										<div class="mt-1 flex rounded-md shadow-sm">
											<input type="password" name="password" id="password" v-model="form.password" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="" />
										</div>
									</div>

									<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
										<label for="confirm_password" class="text-sm font-medium text-gray-500 mt-4"> Confirm Password </label>
										<div class="mt-1 flex rounded-md shadow-sm">
											<input type="password" name="password_confirmation" v-model="form.password_confirmation" id="confirm_password" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="" />
										</div>
									</div>
									<div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
										<button class="bg-orange-600 hover:bg-orange-700 px-4 py-2 text-white font-bold rounded transition" type="submit">Update</button>
									</div>
								</form>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</app-layout>
</template>

<script>
import {ref, onMounted, onBeforeMount} from "@vue/reactivity"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import {PlusIcon} from "@heroicons/vue/outline"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon} from "@heroicons/vue/solid"
import {HomeIcon} from "@heroicons/vue/solid"
import {useForm, Head} from "@inertiajs/inertia-vue3"
const pages = [
	{name: "Home", href: "/app/dashboard", current: false},
	{name: "User", href: "#", current: true},
]
import {Inertia} from "@inertiajs/inertia"
import {UserGroupIcon, MenuIcon, BanIcon, BadgeCheckIcon, EyeIcon, QuestionMarkCircleIcon, CollectionIcon, TrashIcon, ExclamationIcon, PencilAltIcon} from "@heroicons/vue/outline"
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue"
export default {
	components: {
		AppLayout,
		PlusIcon,
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
		Head,
	},
	props: {
		// auth: Object,
		user: Object,
	},
	setup(props) {
		const image = ref(null)
		const form = useForm({
			_method: "PUT",
			name: props.user.name,
			email: props.user.email,
			phone: props.user.phone,
			image: null,
			password: null,
			password_confirmation: null,
		})
		function submit() {
			form.post(route("app.profile.update", props.user.id))
		}

		function upload_image(e) {
			let file = e.target.files[0]
			let reader = new FileReader()

			if (file["size"] < 2111775) {
				reader.onloadend = (file) => {
					image.value = reader.result
				}
				reader.readAsDataURL(file)
			} else {
				alert("File size can not be bigger than 2 MB")
			}
		}
		function get_image() {
			// console.log(image.value)
			let photo = image.value
			return photo
		}

		return {pages, form, submit, upload_image, get_image}
	},
}
</script>
