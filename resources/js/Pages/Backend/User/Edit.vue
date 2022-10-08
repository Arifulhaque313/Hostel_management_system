<template>
	<Head>
		<title>User Edit {{ $page.props.APP_NAME }}</title>
		<meta head-key="description" name="description" content="{{ $page.props.APP_DESCRIPTION }}" />
	</Head>
	<app-layout>
		<Breadcrumb
			:links="[
				{title: 'Dashboard', url: '/app/dashboard'},
				{title: 'Roles', url: '/settings/roles'},
				{title: 'Edit', url: ''},
			]"
		/>
		<div class="w-full lg:w-3/5 mx-auto space-y-3 lg:space-y-6 bg-white rounded-md pb-3 lg:pb-6">
			<div class="border-b border-gray-200 py-2 lg:py-3">
				<!-- Form Header with breadcrumb -->
				<div class="flex items-center justify-between px-2 lg:px-4">
					<div>
						<h1 class="text-lg lg:text-xl text-gray-900 font-semibold">User</h1>
					</div>
				</div>
			</div>
			<!-- User Information Form -->
			<form @submit.prevent="submit" class="px-2 lg:px-4">
				<div class="space-y-3 lg:space-y-8 divide-y divide-gray-200 py-2 lg:py-6 px-2 lg:px-4 border border-gray-200 rounded-md shadow-sm">
					<div>
						<div>
							<h3 class="text-lg leading-6 font-medium text-gray-900">Users Information</h3>
						</div>
						<div class="mt-3 lg:mt-6 grid grid-cols-1 gap-y-2 lg:gap-y-6 gap-x-4 sm:grid-cols-6">
							<div class="sm:col-span-6 space-y-1">
								<Label value="First Name" />
								<input v-model="form.name" type="text" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.name" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Email" />
								<input v-model="form.email" type="email" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.email" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Phone" />
								<input v-model="form.phone" type="text" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.phone" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Role" />
								<select v-model="form.role_id" id="types" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
									<option v-for="(role, index) in roles" :value="role.id" :key="index" class="capitalize">{{ role.name }}</option>
								</select>

								<InputError :message="form.errors.role_id" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Password" />
								<input v-model="form.password" type="password" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.password" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Confirm Password" />
								<input v-model="form.password_confirmation" type="password" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError :message="form.errors.password_confirmation" />
							</div>

							<div class="sm:col-span-6 space-y-1">
								<Label value="Image" />
								<input @input="form.image = $event.target.files[0]" @change="upload_image" id="file-upload" name="file-upload" type="file" class="pt-6 relative max-w-lg block w-full h-20 font-semibold px-4 sm:max-w-full sm:text-base required text-gray-500 focus:outline-none" />
								<img v-if="form.image != null" class="h-32 w-40 m-3 p-3" :src="get_image()" alt="Thumbnail" />
								<img v-if="user.image != null" :src="user.image" alt="" class="h-32 w-40 m-3 p-3" />
							</div>
							<!-- Error message -->
							<InputError :message="form.errors.image" />
						</div>
					</div>
					<div class="pt-5">
						<div class="flex items-center justify-end gap-4">
							<SecondaryButton :href="route('app.users.index')">Cancel</SecondaryButton>
							<PrimaryButton :type="submit"> Update </PrimaryButton>
						</div>
					</div>
				</div>
			</form>
		</div>
	</app-layout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import Breadcrumb from "@/Components/Breadcrumb.vue"
import {useForm, Head} from "@inertiajs/inertia-vue3"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import Label from "@/Jetstream/Label.vue"
import InputError from "@/Jetstream/InputError.vue"
import Dropdown from "@/Jetstream/Dropdown.vue"
import {ref} from "vue"

export default {
	name: "Create",
	components: {
		PrimaryButton,
		SecondaryButton,
		AppLayout,
		Label,
		InputError,
		Dropdown,
		Head,
		Breadcrumb,
	},
	props: {
		roles: Array,
		user: Object,
	},
	setup(props) {
		const form = useForm({
			_method: "PUT",
			name: props.user.name,
			email: props.user.email,
			phone: props.user.phone,
			role_id: props.user.role_id,
			password: null,
			password_confirmation: null,
			image: null,
		})

		function submit() {
			form.post(route("app.users.update", props.user.id))
		}

		const image = ref(null)
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
			let photo = image.value
			return photo
		}

		return {
			submit,
			form,
			upload_image,
			get_image,
		}
	},
}
</script>
