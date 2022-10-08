<template>
	<Link :href="link" class="h-8 lg:h-10 inline-flex items-center px-3 lg:px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150">
		<slot></slot>
	</Link>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3"

export default {
	name: "PrimaryButton",
	props: {
		link: {
			type: String,
			default: "/",
		},
	},
	components: {
		Link,
	},
}
</script>
