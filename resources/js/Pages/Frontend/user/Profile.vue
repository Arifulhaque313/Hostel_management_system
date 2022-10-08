<template>
	<Head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Order History</title>
    </Head>

    <AppLayout>
        <div class="travellers-section bg-gray-50 pt-0 lg:pt-32 px-3">
            <div class="m-auto max-w-5xl">
                <div class="flex">
                    <div class="flex-1">
                        <div class="grid my-12">
                            <div>
                                <div class="grid">
                                    <h5 class="mb-1 text-xs text-gray-600 font-bold">Profile Photo</h5>
                                    <div class="flex justify-start items-center gap-4">
                                        <div class="w-16">
                                            <img :src="get_user_profile_photo ? get_user_profile_photo : '/images/Avatar.png'" :alt="form.name" class="w-16 h-16 mx-auto rounded-full inline-block" />
                                        </div>
                                        <div class="flex-1">
                                            <button @click.stop="active_file()" class="w-20 mt-1 text-sm inline-block py-1 px-1 border border-gray-200 bg-white rounder-md">Change</button>

                                            <input ref="profile" v-show="false" id="profile_photo" name="profile_photo" @input="form.image = $event.target.files[0]" @change="upload_profile_photo($event)" type="file" class="w-1/2 md:w-full mt-1 text-sm inline-block py-1 px-1 border border-gray-200 bg-white rounder-md" />
                                            <span v-if="form.errors.profile_photo" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.profile_photo }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- first row -->
                                <div class="mt-4 sm:mt-8">
                                    <div class="sm:grid sm:grid-cols-2 space-y-3 sm:space-y-0 gap-4">
                                        <div class="col-span-2 relative">
                                            <label for="name" class="absolute -top-2 left-2 bg-gray-50 px-2 block text-sm font-semibold text-gray-600"> Full Name* </label>
                                            <div class="mt-1 flex justify-center items-center border border-gray-300">
                                                <input class="phone-input w-full px-4 py-3 border-none rounded-sm shadow-sm placeholder-gray-400 sm:text-sm" id="name" type="text" placeholder="User Name" v-model="form.name" />
                                            </div>
                                            <span v-if="form.errors.name" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.name }}</span>
                                        </div>

                                    </div>
                                </div>
                                <!-- first row end-->
                                
                                <!-- second row start -->
                                <div class="mt-4 sm:mt-8">
                                    <div class="sm:grid sm:grid-cols-2 space-y-3 sm:space-y-0 gap-4">
                                        <div class="col-span-1 relative">
                                            <label for="name" class="absolute -top-2 left-2 bg-gray-50 px-2 block text-sm font-semibold text-gray-600"> Email* </label>
                                            <div class="mt-1 flex justify-center items-center border border-gray-300">
                                                <input class="phone-input w-full px-4 py-3 border-none rounded-sm shadow-sm placeholder-gray-400 sm:text-sm" id="email" type="email" placeholder="travellers@mail.com" v-model="form.email" />
                                            </div>
                                            <span v-if="form.errors.email" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.email }}</span>
                                        </div>

                                        <div class="col-span-1 relative">
                                            <label for="name" class="absolute -top-2 left-2 bg-gray-50 px-2 block text-sm font-semibold text-gray-600"> Phone* </label>
                                            <div class="mt-1 flex justify-center items-center border border-gray-300">
                                                <input disabled class="phone-input w-full px-4 py-3 border-none rounded-sm shadow-sm placeholder-gray-400 sm:text-sm" id="number" type="number" placeholder="+880 123456789" :value="user.phone"/>
                                            </div>
                                            <span v-if="form.errors.phone" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.phone }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- second row end  -->

                                <!-- third row start -->
                                <div class="mt-4 sm:mt-8">
                                    <div class="sm:grid sm:grid-cols-2 space-y-3 sm:space-y-0 gap-4">
                                       <div class="col-span-1 relative">
                                            <label for="password" class="absolute -top-2 left-2 bg-gray-50 px-2 block text-sm font-semibold text-gray-600"> Password* </label>
                                            <div class="mt-1 flex justify-center items-center border border-gray-300">
                                                <input class="phone-input w-full px-4 py-3 border-none rounded-sm shadow-sm placeholder-gray-400 sm:text-sm" id="password" type="password" placeholder="******" v-model="form.password" />
                                            </div>
                                            <span v-if="form.errors.password" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.password }}</span>
                                        </div>

                                        <div class="col-span-1 relative">
                                            <label for="name" class="absolute -top-2 left-2 bg-gray-50 px-2 block text-sm font-semibold text-gray-600"> Confirm Password* </label>
                                            <div class="mt-1 flex justify-center items-center border border-gray-300">
                                                <input class="phone-input w-full px-4 py-3 border-none rounded-sm shadow-sm placeholder-gray-400 sm:text-sm" id="password" type="password" placeholder="******" v-model="form.password_confirmation" />
                                            </div>
                                            <!-- <span v-if="form.errors.password" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.password }}</span> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- third row end  -->
                                
                                
                                <!-- address  -->
                                <!-- <div class="mt-4 sm:mt-8">
                                    <div class="relative">
                                        <label for="name" class="absolute -top-2 left-2 bg-gray-50 px-2 block text-sm font-semibold text-gray-600"> Address* </label>
                                        <div class="mt-1 flex justify-center items-center border border-gray-300">
                                            <textarea class="h-40 phone-input w-full p-4 py-3 border-none rounded-sm shadow-sm placeholder-gray-400 sm:text-sm" v-model="form.address"></textarea>
                                        </div>
                                        <span v-if="form.errors.address" class="flex items-center justify-center p-2 text-center text-red-700">{{ form.errors.address }}</span>
                                    </div>
                                </div> -->

                                
                                <div class="grid mt-4 sm:mt-8">
                                
                        <div v-if="$page.props.auth.user.role.slug!='agent'">
                                    <button class="shadow w-1/3 mx-auto border bg-orange-400 hover:bg-gray-50 hover:text-orange-400 hover:border-orange-400 shadow-outline focus:outline-none text-white font-bold py-2 text-sm rounded-sm" @click="submit($page.props.auth.user.id)">Update</button>
                        </div>     
                        <div v-else>
                                    <button class="shadow w-1/3 mx-auto border bg-orange-400 hover:bg-gray-50 hover:text-orange-400 hover:border-orange-400 shadow-outline focus:outline-none text-white font-bold py-2 text-sm rounded-sm" @click="agentSubmit()">Update</button>
                        </div>     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-4/12 hidden md:block">
                        <div class="user-aera m-auto mt-6 w-72 border-l border-gray-300 px-6">
                            <h4 class="text-sm p-2 font-s text-gray-700 mb-2">Profile Info</h4>
                            <div class="flex flex-col justify-start">
                                <div class="flex justify-start items-center gap-4 text-gray-600 p-2 hover:bg-gray-200 rounded-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ form.name }}
                                </div>

                                <div v-show="$page.props.auth.user.email!=null" class="flex justify-start items-center gap-4 text-gray-600 p-2 hover:bg-gray-200 rounded-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                                    </svg>
                                    {{ form.email }}
                                </div>
                                <div class="flex justify-start items-center gap-4 text-gray-600 p-2 hover:bg-gray-200 rounded-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    {{ user.phone }}
                                </div>
                                <div v-show="$page.props.auth.user.address!=null" class="flex justify-start items-center gap-4 text-gray-600 p-2 hover:bg-gray-200 rounded-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ form.address }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "../../../Layouts/FrontEnd/AppLayout.vue";
import {Link, Head} from "@inertiajs/inertia-vue3"
import {PlusIcon} from "@heroicons/vue/outline"
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {DotsVerticalIcon} from "@heroicons/vue/solid"
import { PaperClipIcon } from "@heroicons/vue/solid";
export default {
    name: "Profile",
    components: {
        PaperClipIcon,
        AppLayout,
        PlusIcon,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        DotsVerticalIcon,
        Link, 
        Head
    },
    props: {
        user: Object,
        agent: Object
    },
    data(props) {
        return {
            form: this.$inertia.form({
                _method: "PUT",
                name: this.user.name,
                email: this.user.email,
                password: null,
                password_confirmation:null,
                image: null,
                
            }),
            profile_photo_url: this.user.image,
            nid_url: (this.agent==null?null:this.agent.nid),
            trade_license_url: (this.agent==null?null:this.agent.trade_license),
        }
    },
    computed: {
        get_user_profile_photo() {
            return this.profile_photo_url
        },
        get_nid() {
            return this.nid_url
        },
    },
    methods: {
        active_file() {
            this.$refs.profile.click()
        },
        submit(id) {
            this.form.post(this.route("user.profile.update",id), {
                onFinish: () => this.form.reset("password_confirmation","password"),
            })
            // console.log(e);
        },
        agentSubmit() {
            this.form.post(this.route("user.agent.profile.update"), {
                onFinish: () => this.form.reset("password"),
            })
        },
        upload_profile_photo(e) {
            let file = e.target.files[0]
            let reader = new FileReader()
            if (file["size"] < 2111775) {
                reader.onloadend = (file) => {
                    this.profile_photo_url = reader.result
                }
                reader.readAsDataURL(file)
            } else {
                alert("File size can not be bigger than 2 MB")
            }
        },
        
        
    },
}
</script>

<style scoped>
.phone-input {
    background-color: transparent;
    outline: none;
    --tw-ring-color: transparent;
    --tw-ring-offset-shadow: transparent;
    --tw-ring-shadow: none;
    border: none;
}
</style>
