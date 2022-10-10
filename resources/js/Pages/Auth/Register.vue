<script setup>
import {Head, Link, useForm} from "@inertiajs/inertia-vue3"
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import Logo from "@/Jetstream/Logo.vue"
import JetButton from "@/Jetstream/Button.vue"
import JetInput from "@/Jetstream/Input.vue"
import JetCheckbox from "@/Jetstream/Checkbox.vue"
import JetLabel from "@/Jetstream/Label.vue"
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

const form = useForm({
	name: "",
	phone:"",
	email: "",
	password: "",
	password_confirmation: "",
	terms: false,
})

const submit = () => {
	form.post(route("auth.registration"), {
		onFinish: () => form.reset("password", "password_confirmation"),
	})
}
</script>

<template>
	<Head title="Registration" />
	<div class="h-screen flex justify-center items-center">
		<div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-5 lg:flex-none lg:px-12 xl:px-16 z-10 bg-white shadow-xl rounded-md">
			<div class="mx-auto w-full max-w-sm lg:w-96">
				<div class="flex justify-center items-center">
					<h1 class="text-2xl md:text-3xl text-pink-600">Hostel lagbe</h1>
				</div>

				<div class="mt-8 px-4">
					<div class="mt-6">
						<JetValidationErrors class="mb-4" />

						<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
							{{ status }}
						</div>

						<form @submit.prevent="submit">
							<div>
								<JetLabel for="name" value="Full name" />
								<JetInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"  autofocus autocomplete="name" />
							</div>

							<div class="mt-4">
								<JetLabel for="phone" value="Mobile number" />
								<JetInput id="phone" v-model="form.phone" type="tel" class="mt-1 block w-full"  />
							</div>

							<div class="mt-4">
								<JetLabel for="email" value="Email Address" />
								<JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full"  />
							</div>

							<div class="mt-4">
								<JetLabel for="password" value="Password" />
								<JetInput id="password" v-model="form.password" type="password" class="mt-1 block w-full"  autocomplete="new-password" />
							</div>

							<div class="mt-4">
								<JetLabel for="password_confirmation" value="Confirm Password" />
								<JetInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full"  autocomplete="new-password" />
							</div>

							<div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
								<JetLabel for="terms">
									<div class="flex items-center">
										<JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

										<div class="ml-2">I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a></div>
									</div>
								</JetLabel>
							</div>

							<div class="flex items-center justify-end mt-4 mb-2">
								<button type="submit" class="w-full flex justify-center py-2 px-4 mb-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[rgba(209,18,124,0.8)] hover:bg-[rgba(209,18,124,0.99)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">Register</button>
							</div>
							<div class="flex gap-3 justify-between items-center">
								<div class="h-[2px] bg-gray-300 w-full"></div>
								<div class="text-gray-500 flex-shrink-0">Or continue with</div>
								<div class="h-[2px] bg-gray-300 w-full"></div>
							</div>

							<div class="mt-1">
								<button type="submit" class="w-full flex justify-center py-2 px-4 mb-2 border rounded-md shadow-sm text-sm font-medium bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :disabled="form.processing">
								<img src="images/google.png" class="h-6 w-6 rounded-full" alt="">
								</button>
							</div>
							<Link :href="route('login')" class="text-sm text-gray-600 hover:text-gray-900"> Already registered? <span class="text-[#4F46E5] underline">Sign in here</span></Link>
						</form>
					</div>
				</div>
			</div>
		</div>
		<img class="absolute top-0 left-0 h-full w-screen object-cover" src="images/background_login.png" alt="Gallery Image" />
	</div>
</template>
