<template>
    <div class="py-0 sm:py-4 max-w-xs mx-auto sm:max-w-lg sm:flex sm:justify-center">
         <div class="bg-gray-50 mt-4 h-12 relative w-full rounded-md mx-auto sm:inline-grid sm:gap-5">
            <input v-model="search" type="text" placeholder="Enter Package name" name="first_name" id="first_name" autocomplete="given-name" class="h-full text-xs sm:text-base py-3 sm:py-3 pl-2 sm:pl-4 pr-24 sm:pr-28 block w-full shadow-sm text-blue-700 focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-md" />
            <button @click="submit()" class="absolute right-1 top-1 sm:top-1.5 bg-brandColor hover:bg-green-600 text-gray-200 font-normal py-2 px-4 rounded">Search</button>
        </div>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import {ref} from "vue";
export default {
    props:{
        user:Object,
        packageBookings:Array
    },
    setup(props){
        const search=ref(null)
        const submit=()=>{
            if(search.value){
                Inertia.get(route('package'),{
                    'search':search.value
                })
            }
        }
        return{
            search,
            submit
        }
    }
}
</script>

<style></style>
