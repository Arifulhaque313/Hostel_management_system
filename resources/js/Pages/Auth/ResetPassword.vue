<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3"
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import Logo from "@/Jetstream/Logo.vue"
import JetButton from "@/Jetstream/Button.vue"
import JetInput from "@/Jetstream/Input.vue"
import JetLabel from "@/Jetstream/Label.vue"
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

const props = defineProps({
	email: String,
	token: String,
})

const form = useForm({
	token: props.token,
	email: props.email,
	password: "",
	password_confirmation: "",
})

const submit = () => {
	form.post(route("password.update"), {
		onFinish: () => form.reset("password", "password_confirmation"),
	})
}
</script>

<template>
	<Head title="Reset Password" />

	<JetAuthenticationCard class="background">
		<template #logo>
			<Logo />
		</template>

		<JetValidationErrors class="mb-4" />

		<form @submit.prevent="submit">
			<div>
				<JetLabel for="email" value="Email" />
				<JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus />
			</div>

			<div class="mt-4">
				<JetLabel for="password" value="Password" />
				<JetInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
			</div>

			<div class="mt-4">
				<JetLabel for="password_confirmation" value="Confirm Password" />
				<JetInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<JetButton class="w-full flex justify-center bg-indigo-700 hover:bg-indigo-500" :class="{'opacity-25': form.processing}" :disabled="form.processing"> Reset Password </JetButton>
			</div>
		</form>
	</JetAuthenticationCard>
</template>

<style>
.background {
	background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/images/init/artschool05.jpg");
	height: 100%;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
}
</style>
