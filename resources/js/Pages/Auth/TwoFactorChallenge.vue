<script setup>
import {nextTick, ref} from "vue"
import {Head, useForm} from "@inertiajs/inertia-vue3"
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import Logo from "@/Jetstream/Logo.vue"
import JetButton from "@/Jetstream/Button.vue"
import JetInput from "@/Jetstream/Input.vue"
import JetLabel from "@/Jetstream/Label.vue"
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

const recovery = ref(false)

const form = useForm({
	code: "",
	recovery_code: "",
})

const recoveryCodeInput = ref(null)
const codeInput = ref(null)

const toggleRecovery = async () => {
	recovery.value ^= true

	await nextTick()

	if (recovery.value) {
		recoveryCodeInput.value.focus()
		form.code = ""
	} else {
		codeInput.value.focus()
		form.recovery_code = ""
	}
}

const submit = () => {
	form.post(route("two-factor.login"))
}
</script>

<template>
	<Head title="Two-factor Confirmation" />

	<JetAuthenticationCard class="background">
		<template #logo>
			<Logo />
		</template>

		<div class="mb-4 text-sm text-gray-600">
			<template v-if="!recovery"> Please confirm access to your account by entering the authentication code provided by your authenticator application. </template>

			<template v-else> Please confirm access to your account by entering one of your emergency recovery codes. </template>
		</div>

		<JetValidationErrors class="mb-4" />

		<form @submit.prevent="submit">
			<div v-if="!recovery">
				<JetLabel for="code" value="Code" />
				<JetInput id="code" ref="codeInput" v-model="form.code" type="text" inputmode="numeric" class="mt-1 block w-full" autofocus autocomplete="one-time-code" />
			</div>

			<div v-else>
				<JetLabel for="recovery_code" value="Recovery Code" />
				<JetInput id="recovery_code" ref="recoveryCodeInput" v-model="form.recovery_code" type="text" class="mt-1 block w-full" autocomplete="one-time-code" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer" @click.prevent="toggleRecovery">
					<template v-if="!recovery"> Use a recovery code </template>

					<template v-else> Use an authentication code </template>
				</button>

				<JetButton class="ml-4 w-full flex justify-center bg-indigo-700 hover:bg-indigo-500" :class="{'opacity-25': form.processing}" :disabled="form.processing"> Log in </JetButton>
			</div>
		</form>
	</JetAuthenticationCard>
</template>

<style>
.background {
	background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/images/init/artschool06.jpg");
	height: 100%;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
}
</style>
