<template>
    <div>
        <Head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Hostel Details page</title>
        </Head>
        <AppLayout>
            <section class="bg-white py-5">
                <div class="my-10 max-w-7xl px-4 md:px-12 mx-auto flex flex-col justify-center items-center">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-xl  pb-3 px-4">Hostel Details Page</h3>
                    <h1 class="playfair_custom font-medium text-2xl px-4 text-center"></h1>


                    <div class="grid grid-cols-12 gap-6 py-12">
                        <!-- left content  -->
                        <div class="col-span-12 md:col-span-6">
                            <div class="h-full w-full">
                                <img :src="`/storage/`+hostel.thumbnail" alt="thumbnail" class="h-2/3 w-full rounded-lg">

                                <div class="mt-8">
                                    <Link :href="route('hostels.show',hostel.id)">
                                        <button class="px-12 py-2 bg-pink-600 text-white font-bold rounded-full">
                                          Book Now
                                        </button>
                                    </Link>
                                </div>
                            </div>
                            
                        </div>
                        <!-- right content  -->
                        <div class="col-span-12 md:col-span-6">
                            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Room Information</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">All the Details and Specification.</p>
                                </div>
                                <div class="border-t border-gray-200">
                                    <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Title</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.title}}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Owner name</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.owner}}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Owner Phone Number</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.owner_num}}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Area</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.area}}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.address}}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Type</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.type}}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">If Bachelor</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.person}} Roomate</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Rent</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.rent }} BDT</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{hostel.description}}</dd>
                                    </div>
                                   
                                    </dl>
                                </div>
                                </div>

                        </div>
                    </div>
                </div>
            </section>
           
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
import {useForm, Head, Link} from "@inertiajs/inertia-vue3"
export default{
    name: 'Hostel Details page',
    components:{
        AppLayout,
        Head,
		Link,
    },
    props:{
        hostel:Object
    },
    setup() {
	
		return {			
			
		}
	},
   
}
</script>

<style scoped>
.playfair_custom {    
  font-family: "Playfair Display", serif;
}

textarea{
    resize: none;
}
</style>