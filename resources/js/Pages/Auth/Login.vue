<script setup>
import {Head, Link, useForm} from "@inertiajs/inertia-vue3"
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import Logo from "@/Jetstream/Logo.vue"
import JetButton from "@/Jetstream/Button.vue"
import JetInput from "@/Jetstream/Input.vue"
import JetCheckbox from "@/Jetstream/Checkbox.vue"
import JetLabel from "@/Jetstream/Label.vue"
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

defineProps({
	canResetPassword: Boolean,
	status: String,
})

const form = useForm({
	email: "",
	password: "",
	remember: false,
})

const submit = () => {
	form.transform((data) => ({
		...data,
		remember: form.remember ? "on" : "",
	})).post(route("login"), {
		onFinish: () => form.reset("password"),
	})
}

</script>

<template>
	<Head title="Login" />
	<div class="h-screen flex justify-center items-center">
		<div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-5 lg:flex-none lg:px-12 xl:px-16 z-10 bg-white shadow-xl rounded-md">
			<div class="mx-auto w-full max-w-sm lg:w-96">
				<div class="flex justify-center items-center">
					<h1 class="text-xl md:text-3xl text-pink-600 font-bold">Hostel Lagbe</h1>
				</div>

				<div class="mt-8 px-4">
					<div class="mt-6">
						<JetValidationErrors class="mb-4" />

						<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
							{{ status }}
						</div>
						<form @submit.prevent="submit" class="space-y-6">
							<div>
								<label for="email" class="block text-sm font-medium text-gray-700"> Email or Mobile </label>
								<div class="mt-1">
									<input id="email" v-model="form.email" name="email" type="text" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
								</div>
							</div>

							<div class="space-y-1">
								<label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
								<div class="mt-1">
									<input id="password" v-model="form.password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
								</div>
							</div>

							<div class="flex items-center justify-between">
								<div class="flex items-center">
									<input id="remember-me" v-model="form.remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
									<label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
								</div>
								<div class="font-semibold text-indigo-600">
									<p class="hover:underline cursor-pointer">Forgot Password?</p>
								</div>
							</div>

							<div>
								<button type="submit" class="w-full flex justify-center py-2 px-4 mb-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[rgba(209,18,124,0.8)] hover:bg-[rgba(209,18,124,0.99)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Sign in</button>
							</div>

							<div class="flex gap-3 justify-between items-center py-3">
								<div class="h-[2px] bg-gray-300 w-full"></div>
								<div class="text-gray-500 flex-shrink-0">Or continue with</div>
								<div class="h-[2px] bg-gray-300 w-full"></div>
							</div>

							<div>
								<button type="submit" class="w-full flex justify-center py-2 px-4 mb-2 border rounded-md shadow-sm text-sm font-medium bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">
								<img src="images/google.png" class="h-6 w-6 rounded-full" alt="">
								</button>
							</div>
							<Link :href="route('register')" class="text-sm text-gray-600 hover:text-gray-900"> New member? <span class="text-[#4F46E5] underline">Register here</span></Link>
						</form>
					</div>
				</div>
			</div>
		</div>
		<img class="absolute top-0 left-0 h-full w-screen object-cover" src="images/background_login.png" alt="Gallery Image" />
	</div>
</template>
