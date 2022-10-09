<template> 
    <div>
        <Head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Hostel Details page</title>
        </Head>
        <AppLayout>
                <div class="max-w-7xl px-4 md:px-16 mx-auto">
                    <div class="bg-white rounded-md border shadow-lg overflow-hidden max-w-3xl mx-auto px-4 py-8 my-12">
                        <div class="flex justify-center mb-6">
                            <p class="text-pink-600 text-xl md:text-3xl font-bold italic">Booking Form</p>
                        </div>
                        <form @submit.prevent="submit">
                            
                            <div class="col-span-12 mt-4 hidden">
                                <label for="title" class="block text-sm font-medium text-gray-700">Hostel Id</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="hostel_id" id="hostel_id" class="block w-full pr-10 sm:text-sm rounded-md"  aria-invalid="true" aria-describedby="email-error" v-model="form.hostel_id" />
                                </div>
                                
                            </div>

                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 ">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Permanent Address</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" name="address" id="address" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="" aria-invalid="true" aria-describedby="email-error" v-model="form.address" />
                                    </div>
                                    <span v-if="form.errors.address" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.address }}</span>
                                </div>

                                <div class="col-span-12 md:col-span-6 ">
                                    <label for="info" class="block text-sm font-medium text-gray-700">Personal Number</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" name="title" id="info" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="" aria-invalid="true" aria-describedby="email-error" v-model="form.mobile" />
                                    </div>
                                    <span v-if="form.errors.mobile" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.mobile }}</span>
                                </div>
                            </div>

                            <div class="col-span-12 mt-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Qualification</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="title" id="title" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="write your current qualification or educational status" aria-invalid="true" aria-describedby="email-error" v-model="form.qualification" />
                                </div>
                                <span v-if="form.errors.qualification" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.qualification }}</span>
                            </div>


                            <div class="grid grid-cols-12 gap-4 mt-4">

                                <div class="col-span-12 md:col-span-6 ">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Booking Advance Amount</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" name="title" id="title" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="20% minimum" aria-invalid="true" aria-describedby="email-error" v-model="form.advance" />
                                    </div>
                                    <span v-if="form.errors.advance" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.advance }}</span>
                                </div>

                                <div class="col-span-12 md:col-span-6 ">
                                    <label for="info" class="block text-sm font-medium text-gray-700">Bkash or Nogod Transaction Id</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" name="title" id="info" class="block w-full pr-10 sm:text-sm rounded-md" placeholder="" aria-invalid="true" aria-describedby="email-error" v-model="form.trx_id" />
                                    </div>
                                    <span v-if="form.errors.trx_id" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.trx_id }}</span>
                                </div>
                            </div>
                

                            <div class="mt-4">
                                <label for="author" class="block text-sm font-medium text-gray-700">Short Description</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <textarea v-model="form.description" name="" id="" cols="30" rows="4" placeholder="Its like any food related allergies or any medical related problems" class="block w-full pr-10 sm:text-sm rounded-md"></textarea>
                                </div>
                                <!-- <span v-if="form.errors.rent" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.rent }}</span> -->
                            </div>


                            <div class="mt-8 relative flex items-center border border-gray-200 rounded-sm">
                                <label class="absolute -top-4 z-10 text-xs md:text-base font-semibold text-gray-500 ml-4 bg-gray-50 p-1">Student or NID or Passpord card Image</label>
                                <input @input="form.thumbnail = $event.target.files[0]" @change="upload_thumbnail" id="file-upload" name="file-upload" type="file" class="pt-6 relative max-w-lg block w-full h-20 font-semibold px-4 sm:max-w-full sm:text-base required text-gray-500 focus:outline-none" />
                                <img v-if="get_thumbnail()" class="h-32 w-40 m-3 p-3" :src="get_thumbnail()" alt="Thumbnail" />
                            </div>
                            <span v-if="form.errors.thumbnail" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.thumbnail }}</span>
                        
                            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                                <div class="flex items-center justify-end gap-4">
                                    <SecondaryButton :href="route('app.hostels.index')">Cancel</SecondaryButton>
                                    <PrimaryButton :type="submit"> Save </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </AppLayout>
    </div>
</template>

<script>
import AppLayout from "../../../Layouts/FrontEnd/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue"
import {useForm, Head, Link} from "@inertiajs/inertia-vue3"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import {ref} from "vue"

export default {
    name: "Booking hostel form",
    components:{
        AppLayout ,PrimaryButton,
		SecondaryButton,
        useForm
    },
    props:{
        hostel_id:Object
    },
    setup(props) {
		const form = useForm({
			address: null,
            mobile: null,
			qualification: null,
			advance: null,
			trx_id: null,
			thumbnail: null,
			description: null,
            hostel_id:props.hostel_id	
		})
		const thumbnail = ref(null)
		function upload_thumbnail(e) {
			let file = e.target.files[0]
			let reader = new FileReader()
			if (file["size"] < 2111775) {
				reader.onloadend = (file) => {
					thumbnail.value = reader.result
				}
				reader.readAsDataURL(file)
			} else {
				alert("File size can not be bigger than 2 MB")
			}
		}
		function get_thumbnail() {
			let photo = thumbnail.value
			return photo
		}
		function submit() {
			form.post(route("store.booking"), {
				// onSuccess: () => {
				// 	form.reset("title", "description", "category_id")
				// },
			})
		}

		return {
			form,
			submit,
			thumbnail,
			// thumbnailPreview,
			get_thumbnail,
			upload_thumbnail
		}
	},
}
</script>

<style>

</style>