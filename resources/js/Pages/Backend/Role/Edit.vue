<template>
	<Head>
		<title>Role Create {{ $page.props.APP_NAME }}</title>
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
						<h1 class="text-lg lg:text-xl text-gray-900 font-semibold">Update Role</h1>
					</div>
				</div>
			</div>
			<!-- User Information Form -->
			<form @submit.prevent="submit" class="px-2 lg:px-4">
				<div class="space-y-3 lg:space-y-8 divide-y divide-gray-200 py-2 lg:py-6 px-2 lg:px-4 border border-gray-200 rounded-md shadow-sm">
					<div>
						<div>
							<h3 class="text-lg leading-6 font-medium text-gray-900">Roles Information</h3>
							Manage permissions for role
						</div>
						<div class="mt-3 lg:mt-6 grid grid-cols-1 gap-y-2 lg:gap-y-6 gap-x-4 sm:grid-cols-6">
							<div class="sm:col-span-6 space-y-1">
								<Label value="Role Name" />
								<input v-model="form.name" type="text" class="h-10 w-full p-2 block text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:border-primary" />
								<!-- Error message -->
								<InputError />
							</div>

							<div v-for="(module, index) in modules" :key="index" class="sm:col-span-6 space-y-3">
								<strong class="text-sm">{{ module.name }}</strong>
								<div v-for="(permission, index) in module.permissions" :key="index" class="flex items-center gap-2">
									<input :id="'#permission-' + permission.id" v-model="form.permissions" type="checkbox" class="focus:ring-0 h-4 w-4 text-primary border-gray-300 rounded" :value="permission.id" name="permissions[]" />
									<label class="custom-control-label" :for="'#permission-' + permission.id">{{ permission.name }}</label>
								</div>
							</div>
						</div>
					</div>
					<div class="pt-5">
						<div class="flex items-center justify-end gap-4">
							<SecondaryButton :href="route('app.roles.index')">Cancel</SecondaryButton>
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
import Breadcrumb from "@/Components/Breadcrumb.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import {useForm, Head} from "@inertiajs/inertia-vue3"
import AppLayout from "../../../Layouts/Backend/AppLayout.vue"
import Label from "@/Jetstream/Label.vue"
import Input from "@/Jetstream/Input.vue"
import Dropdown from "@/Jetstream/Dropdown.vue"

export default {
	name: "Edit",
	components: {
		PrimaryButton,
		SecondaryButton,
		AppLayout,
		Label,
		Input,
		Dropdown,
		Head,
		Breadcrumb,
	},
	props: {
		modules: Array,
		role: Object,
	},
	setup(props) {
		const form = useForm({
			_method: "PUT",
			name: props.role.name,
			permissions: props.role.permissions.map((element) => {
				return element.id
			}),
		})

		function submit() {
			form.post(route("app.roles.update", props.role.id))
		}

		return {
			submit,
			form,
		}
	},
}
</script>
