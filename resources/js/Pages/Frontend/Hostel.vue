<template>
    <div>
        <Head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Hostel</title>
        </Head>
        <AppLayout>
            <section class="bg-white py-5">

                <div class="flex justify-center">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-xl  pb-3 px-4">Find One</h3>
                </div>
                <!-- filter options  -->
                <div>
                    <div class="md:max-w-5xl max-w-sm mx-auto bg-white border  bg-opacity-75 items-center rounded-lg md:px-8 py-6 px-6 md:py-4">
                        
                        <form action="#">
                            <div class="md:flex w-full space-y-3 md:space-y-0">
                                <div class="flex-1">
                                    <label for="looking_for" class="block font-bold text-gray-800 text-sm">Area</label>
                                    <select 
                                        id="" name=""
                                        class="w-full block border pl-3 mt-1 md:w-8/12 md:pr-5 md:py-2 py-1 text-base  md:text-sm rounded-md" v-model='form.area'>
                                        <option value=""></option>
                                        	<option value="dhaka">Dhaka</option>
                                            <option value="Uttora">Uttora</option>
                                            <option value="dhanmondi">Dhanmondi</option>
                                            <option value="panthpath">Panthpath</option>
                                            <option value="mirpur">Mirpur</option>
                                            <option value="shabug">Shabug</option>
                                            <option value="firmgate">Shabug</option>
                                    </select>
                                </div>
                                <div class="flex-1 ">
                                    <label for="age_from" class="block font-bold text-gray-800 text-sm">Rent</label>
                                    <div class="flex items-center md:block">
                                        <select id="=rent" name="rent"
                                                class="flex-grow inline-block border px-2 mt-1 w-6/12 md:w-4/12 md:py-2 py-1 text-base  md:text-sm rounded-md" v-model="form.rent_form">
                                                    <option value=""></option>
                                                    <option value="1500">1500</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2500">2500</option>
                                                    <option value="3000">3000</option>
                                                    <option value="3500">3500</option>
                                                    <option value="4000">4000</option>
                                                    <option value="5000">5000</option>
                                                    <option value="5500">5500</option>
                                                    <option value="6000">6000</option>
                                                    <option value="6500">6500</option>
                                                    <option value="7000">7000</option>
                                        </select>
                                        <span class="mx-3 md:mx-1">to</span>
                                        <select id="rent" name="rent" 
                                                class="flex-grow inline-block border px-2 mt-1 w-6/12 md:w-4/12 md:py-2 py-1 text-base  md:text-sm rounded-md" v-model="form.rent_to">
                                                    <option value=""></option>
                                                    <option value="2000">2000</option>
                                                    <option value="2500">2500</option>
                                                    <option value="3000">3000</option>
                                                    <option value="3500">3500</option>
                                                    <option value="4000">4000</option>
                                                    <option value="5000">5000</option>
                                                    <option value="5500">5500</option>
                                                    <option value="6000">6000</option>
                                                    <option value="6500">6500</option>
                                                    <option value="7000">7000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <label for="religion" class="block font-bold text-gray-800 text-sm">Setting type</label>
                                    <select
                                        id="type" name="type" 
                                        class="w-full border px-2 mt-1 block md:w-11/12 md:pr-8 md:py-2 py-1 text-base md:text-sm rounded-md" v-model="form.type">
                                        <option value=""></option>
                                        <option value="single">Single</option>
                                        <option value="bachelor">Bachelor</option>
                                    </select>
                                </div>
                                <div class="flex-1 text-right py-2">
                <!--                    <button type="button" v-if="$page.props.auth.user && $page.props.auth.user.partner_preference" @click="filtration"-->
                <!--                        class="bg-pink-600 rounded uppercase hover:bg-pink-700 text-white px-4 py-2 md:py-0 md:w-auto w-full h-full">-->
                <!--                        search-->
                <!--                    </button>-->
                                    <button type="button" @click="submit"
                                        class="bg-pink-600 rounded uppercase hover:bg-pink-700 text-white px-4 py-2 md:py-0 md:w-auto w-full h-full">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- filter option end  -->
                <div class="my-10 max-w-7xl px-4 md:px-12 mx-auto flex flex-col justify-center items-center">
                    
                    <h1 class="playfair_custom font-medium text-2xl px-4 text-center"></h1>

                    <div class="mt-8">
                        <!-- podcast episode start  -->
                        <div class="py-4 md:py-4 grid grid-cols-12 px-4 md:px-0 gap-y-2 md:gap-8">
                            <div class="col-span-12 md:col-span-4 bg-white p-6 rounded-lg border-2"  v-for="(hostel,index) in hostels" :key="index">
                                <div>
                                    <!-- hostel thumnail  -->
                                    <div class="">
                                        <img :src="`/storage/`+hostel.thumbnail" alt="" class="h-full w-full rounded-t-xl">
                                    </div>
                                
                                    <div class="my-8">
                                        <!-- rent  -->
                                        <div class="flex justify-between px-4 pb-3">
                                            <p class="font-bold">Room Type : {{hostel.type}}</p>
                                            <p class="font-bold">{{hostel.rent}} <span>TK</span></p>
                                        </div>

                                        <!-- address  -->
                                        <div class="justify-center mb-2">
                                            <div class="flex justify-center gap-1">
                                                <p class="text-red-600 font-bold">Area:</p>
                                                <p class="first_letter_capital text-red-600 font-bold">{{ hostel.area}}</p>
                                            </div>
                                            <div class="flex justify-center">
                                                <p class="mt-1 font-bold">Address : {{hostel.address}}</p>
                                            </div>
                                        </div>

                                        <div class="flex justify-center mt-4">
                                            <Link :href="route('hostels.show',hostel.id)">
                                                <button class="px-12 py-2 bg-pink-600 text-white font-bold rounded-full">
                                                More Details
                                                </button>
                                            </Link>
                                        </div>
                                    </div>
                                    
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
    name: 'Hostel',
    components:{
        AppLayout,
        Head,
		Link,
    },
    props:{
        hostels:Object
    },
    setup() {
		const form = useForm({
			area: null,
            rent_form: null,
            rent_to: null,
            type: null,
		})
		
		function submit() {
			form.post(route("basic.filtration"), {
				// onSuccess: () => {
				// 	form.reset("title", "description", "category_id")
				// },
			})
		}

		return {
			form,
			submit,
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