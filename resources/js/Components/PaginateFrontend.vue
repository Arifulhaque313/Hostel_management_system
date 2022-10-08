<template>
	<div class="container mx-auto px-4 py-8">
		<nav class="flex flex-row flex-nowrap justify-center items-center" aria-label="Pagination">
			<template v-for="(link, index) in links" :key="index">
				<Link v-if="link.url" :class="link.active ? 'flex bg-[#D1127C] md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-brandColor bg-brandColor text-white pointer-events-none' : 'flex md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-brandColorNew bg-white text-[rgba(0,0,0,0.35)] hover:border-brandColor'" title="Page 1" :href="link.url">{{ link.label.includes("Previous") ? "<<" : link.label && link.label.includes("Next") ?  ">>" : link.label }}</Link>
			</template>
		</nav>
	</div>
</template>

<script>
import {onBeforeMount, ref} from "vue"
import {Inertia} from "@inertiajs/inertia"
import {Link} from "@inertiajs/inertia-vue3"

export default {
	components: {Link},
	props: {
		links: Array,
	},

	setup(props) {},
}
</script>
