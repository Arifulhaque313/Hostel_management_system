<script setup>
import {ref} from "vue"
import {Head, useForm} from "@inertiajs/inertia-vue3"
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import Logo from "@/Jetstream/Logo.vue"
import JetButton from "@/Jetstream/Button.vue"
import JetInput from "@/Jetstream/Input.vue"
import JetLabel from "@/Jetstream/Label.vue"
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

const form = useForm({
	password: "",
})

const passwordInput = ref(null)

const submit = () => {
	form.post(route("password.confirm"), {
		onFinish: () => {
			form.reset()

			passwordInput.value.focus()
		},
	})
}
</script>

<template>
	<Head title="Secure Area" />

	<JetAuthenticationCard class="background">
		<template #logo>
			<Logo />
		</template>

		<div class="mb-4 text-sm text-gray-600">This is a secure area of the application. Please confirm your password before continuing.</div>

		<JetValidationErrors class="mb-4" />

		<form @submit.prevent="submit">
			<div>
				<JetLabel for="password" value="Password" />
				<JetInput id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="current-password" autofocus />
			</div>

			<div class="flex justify-end mt-4">
				<JetButton class="ml-4 w-full flex justify-center bg-indigo-700 hover:bg-indigo-500" :class="{'opacity-25': form.processing}" :disabled="form.processing"> Confirm </JetButton>
			</div>
		</form>
	</JetAuthenticationCard>
</template>

<style>
.background {
	background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/images/init/artschool04.jpg");
	height: 100%;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
}
</style>
