<script setup>
import {computed} from "vue"
import {Head, Link, useForm} from "@inertiajs/inertia-vue3"
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import Logo from "@/Jetstream/Logo.vue"
import JetButton from "@/Jetstream/Button.vue"

const props = defineProps({
	status: String,
})

const form = useForm()

const submit = () => {
	form.post(route("verification.send"))
}

const verificationLinkSent = computed(() => props.status === "verification-link-sent")
</script>

<template>
	<Head title="Email Verification" />

	<JetAuthenticationCard class="background">
		<template #logo>
			<Logo />
		</template>

		<div class="mb-4 text-sm text-gray-600">Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</div>

		<div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">A new verification link has been sent to the email address you provided in your profile settings.</div>

		<form @submit.prevent="submit">
			<div class="mt-4 flex items-center justify-between">
				<JetButton class="w-full flex justify-center bg-indigo-700 hover:bg-indigo-500" :class="{'opacity-25': form.processing}" :disabled="form.processing"> Resend Verification Email </JetButton>
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
