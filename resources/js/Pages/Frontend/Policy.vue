<template>
    <AppLayout>
        <Head>
            <Title>Policy</Title>
        </Head>
        <div class="bg-[url('/images/background_login.png')]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 ">
                <div class="my-5 max-w-7xl mx-auto flex flex-col justify-center items-center">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-lg py-2">Policies</h3>
                </div>
                <div class="my-10">
                    <ul class="list-disc list-inside my-5">
                        <p class="underline text-lg font-medium">Drop-off and Pick-up Procedure</p>
                        <li class="text-base font-normal ">Students must sign in during drop-off</li>
                        <li class="text-base font-normal ">Parents must sign out during pick-up</li>
                        <li class="text-base font-normal ">Pick up other than parents or guardian must provide written permission in advance</li>
                        <li class="text-base font-normal ">Absent / Late - Please call to report the absence and to reschedule make up class</li>
                    </ul>
                    <ul class="list-disc list-inside my-5">
                        <p class="underline text-lg font-medium">Payment</p>
                        <li class="text-base font-normal ">Tuition due one week prior to beginning of month</li>
                        <li class="text-base font-normal ">9 monthly payments OR 3 quarterly payments</li>
                        <li class="text-base font-normal ">Checks payable to The Art Studio of Lake Mary</li>
                        <li class="text-base font-normal ">Late Payments & Returned Checks - $30 fee</li>
                        <li class="text-base font-normal ">Thirty-day written notice for program withdrawal</li>
                    </ul>
                    <ul class="list-disc list-inside my-5">
                        <p class="underline text-lg font-medium">Art Studio T-Shirt for classes - $12</p>
                        <!-- <li class="text-base font-normal ">Art Studio T-Shirt for classes - $12</li> -->
                    </ul>
                    <ul class="list-disc list-inside my-5">
                        <p class="underline text-lg font-medium">New and Returning Students Forms to be Filled out by Parents or Guardians</p>
                        <li class="text-base font-normal ">Annual Registration</li>
                        <li class="text-base font-normal ">Student Information</li>
                        <li class="text-base font-normal ">Permission Slips</li>
                        <li class="text-base font-normal ">New Students/Parents: Schedule an orientation before registration</li>
                        <li class="text-base font-normal ">Sign-up and Register at Art School</li>
                    </ul>
                    <ul class="list-disc list-inside">
                        <p class="underline text-lg font-medium">Drawing Journal</p>
                        <li class="text-base font-normal ">Sketching 30 - 45 minutes daily is recommended </li>
                        <li class="text-base font-normal ">Earn bonus points by turning in sketchbook/drawing-folder worked on at home monthly</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </AppLayout>
</template>

<script>
    import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
    import { Head } from "@inertiajs/inertia-vue3"; 
export default {
    name: 'subject',
    components:{
        AppLayout,
        Head
    },
}
</script>