<template>
	<button :type="type" class="h-8 lg:h-10 inline-flex items-center px-3 lg:px-4 py-2 bg-pink-600 hover:bg-pink-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark active:bg-dark focus:outline-none focus:shadow-outline-gray transition ease-in-out duration-150">
		<slot />
	</button>
</template>

<script>
export default {
	name: "PrimaryButton",
	props: {
		type: {
			type: String,
			default: "submit",
		},
	},
}
</script>
