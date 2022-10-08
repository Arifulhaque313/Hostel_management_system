<template>
    <div>
        <Head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Contact</title>
        </Head>
        <AppLayout>
            <section class="bg-white py-5">
                <div class="my-10 max-w-7xl mx-auto flex flex-col justify-center items-center">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-xl  pb-3 px-4">Contact Us</h3>
                    <h1 class="playfair_custom font-medium text-2xl px-4 text-center">Our Schools are the Right Fit for Your
                        Child. We are Near Your Place!</h1>
                </div>
            </section>
            <section class="my-5 max-w-7xl mx-auto grid grid-cols-12 gap-5">
                <div class="col-span-12 md:col-span-5 flex flex-col justify-between my-8 px-3">
                    <div class="flex gap-4 my-4">
                        <div class="w-12 h-12 flex-shrink-0 rounded-full overflow-hidden">
                            <img src="/images/icons/location_icon.png" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex flex-col justify-between px-4">
                            <h3 class="playfair_custom font-medium">Our Location</h3>
                            <p>241 N. Country Club Road, Suite 1017 Lake Mary FL 32746</p>
                        </div>
                    </div>

                    <div class="flex gap-4 my-4">
                        <div class="w-12 h-12 flex-shrink-0 rounded-full overflow-hidden">
                            <img src="/images/icons/phone_icon.png" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex flex-col justify-between px-4">
                            <h3 class="playfair_custom font-medium">Phone Number</h3>
                            <p>407-330-1135</p>
                        </div>
                    </div>

                    <div class="flex gap-4 my-4">
                        <div class="w-12 h-12 flex-shrink-0 rounded-full overflow-hidden">
                            <img src="/images/icons/message_icon.png" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex flex-col justify-between px-4">
                            <h3 class="playfair_custom font-medium">Email Address</h3>
                            <p>stellatagliavore@yahoo.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-7">
                    <form @submit.prevent="submit" class="px-4">
                        <div class="w-full rounded-3xl overflow-hidden">
                            <div class="h-full w-full bg-no-repeat bg-center md:bg-cover bg-[url('/images/contact_form.png')]">
                                <div class="p-4 flex flex-col">
                                    <div class="grid grid-cols-2 my-2 gap-2">   
                                        <div class="col-span-2 md:col-span-1">
                                            <input v-model="form.name" type="text"  placeholder="Name" class="bg-white border-white rounded-xl w-full">
                                            <span v-if="form.errors.name" class="flex items-center p-2 text-red-700 ">{{ form.errors.name }}</span>
                                        </div>
                                    
                                        <div class="col-span-2 md:col-span-1">
                                            <input v-model="form.email" type="email" placeholder="Email address" class="bg-white border-white rounded-xl w-full">
                                            <span v-if="form.errors.email" class="flex items-center p-2 text-red-700 ">{{ form.errors.email }}</span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 mb-2 gap-2">   
                                        <div class="col-span-2 md:col-span-1">
                                            <input v-model="form.location" type="text"  placeholder="Your Location" class="bg-white border-white rounded-xl w-full">
                                            <span v-if="form.errors.location" class="flex items-center p-2 text-red-700 ">{{ form.errors.location }}</span>
                                        </div>
                                    
                                        <div class="col-span-2 md:col-span-1">
                                            <input v-model="form.subject" type="text" placeholder="Subject" class="bg-white border-white rounded-xl w-full">
                                            <span v-if="form.errors.subject" class="flex items-center p-2 text-red-700 ">{{ form.errors.subject }}</span>
                                        </div>
                                    </div>
                                
                                    <textarea v-model="form.message" type="text" id="" cols="30" rows="6" class="border-white mt-3 rounded-lg" placeholder="Message"></textarea>
                                    <span v-if="form.errors.message" class="flex items-center p-2 text-red-700 ">{{ form.errors.message }}</span>
                                    <div class="flex justify-center items-center mt-4">
                                        <button type="submit" class="uppercase px-5 py-3 bg-[#D1127C] hover:bg-transparent text-white hover:text-black border-[2px] border-[#D1127C] font-medium rounded-[50px]">
                                            Contact Us
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
import {useForm, Head, Link} from "@inertiajs/inertia-vue3"
export default{
    name: 'contactStore',
    components:{
        AppLayout,
        Head,
		Link,
    },
    setup() {
		const form = useForm({
			name:null,
            email:null,
            location:null,
            subject:null,
            message:null,
		})		

		function submit() {
			form.post(route("contact.store"));
		}		
		
		return {			
			submit,	
            form
		}
	},
    watch :{
        "$page.props.flash":{
            handler(data){
                if(data.success){
                    this.form.reset();
                }                
            }
        }
    }
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