<script setup>
import {Link} from "@inertiajs/inertia-vue3"
const appName = process.env.APP_NAME
</script>

<template>
	<Link :href="'/'">
		<img class="h-12 w-auto" src="/images/init/logo.png" :alt="appName" />
	</Link>
</template>
