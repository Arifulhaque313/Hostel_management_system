<template>
	<nav class="flex py-2" aria-label="Breadcrumb">
		<ol class="flex items-center space-x-1">
			<li v-for="(link, index) in links" :key="link.title">
				<div class="flex items-center gap-1">
					<ChevronRightIcon v-if="index !== 0" class="flex-shrink-0 h-4 w-4 text-gray-400" />
					<Link :href="link.url" class="text-sm leading-4 font-medium text-gray-500 hover:text-gray-600">{{ link.title }}</Link>
				</div>
			</li>
		</ol>
	</nav>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3"
import {ChevronRightIcon} from "@heroicons/vue/outline"

export default {
	name: "Breadcrumb",
	components: {
		Link,
		ChevronRightIcon,
	},
	props: {
		links: Array,
	},
}
</script>
