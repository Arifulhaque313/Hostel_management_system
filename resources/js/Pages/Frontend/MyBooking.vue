<template>
  <div>
    <Head>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>My Bookings</title>
    </Head>
    <AppLayout>
      <div class="max-w-7xl  px-4 md:px-12 py-5 mx-auto">
        <div class="mt-8 flex flex-col">
          <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
              <div class="overflow-hidden">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6 gap-4 px-4 md:px-0">
                          <div class="my-4">
                              <p class="text-2xl md:text-4xl">This is your booking list</p>
                              <ul class="pl-4 md:pl-12 pt-4">
                                  <li class="list-decimal leading-7">If you are not interested then you can cancel it</li>
                                  <li class="list-decimal leading-7">Advance money will be refund in 3 days</li>
                                  <li class="list-decimal leading-7">If there any issues you can contact with admin</li>
                              </ul>
                          </div>
                    </div>

                    <!-- 
                    status 0 = Processing
                    status 1 = confirm 
                    status 2 = rejected  
                    -->


                     <div class="col-span-12 md:col-span-6 gap-4 px-4 md:px-9">
                         <div class="mb-2 border border-pink-600 p-6 rounded-lg" v-for="(my_booking,index) in my_bookings" :key="index">
                             <p class="font-bold py-2">Booking id : {{my_booking.id}}</p>
                             <p class="font-bold py-2">Hostel Id : {{my_booking.hostel.id}}</p>
                             <p class="font-bold py-2">Hostel Owner name: {{my_booking.hostel.owner}}</p>
                             <p class="font-bold py-2">Area : {{my_booking.hostel.area}}</p>
                             <p class="font-bold py-2">Address : {{my_booking.hostel.address}}</p>
                             <p class="font-bold py-2">Rent : {{my_booking.hostel.rent}}</p>
                             <p class="font-bold py-2">Advance pay  : {{my_booking.advance}}</p>
                             <div class="font-bold py-2 flex items-center gap-4">
                                  <p>Status : </p>
                                  <p v-if="my_booking.status == 0" class="px-6 text-white rounded-full text-sm py-1 bg-cyan-600">Processing</p>
                                  <p v-if="my_booking.status == 1" class="px-6 text-white rounded-full text-sm py-1 bg-green-600">Confirm</p>
                                  <p v-if="my_booking.status == 2" class="px-6 text-white rounded-full text-sm py-1 bg-red-600">Rejected/Cancel Booking</p>
                             </div>
                             

                             <div class="flex gap-4 pt-4">
                                <Link>
                                    <button class="px-8 py-2 bg-green-600 text-white rounded-lg">More Details</button>
                                </Link>
                                <Link :href="route('booking.cancel',my_booking.id)">
                                    <button class="px-8 py-2 bg-red-600 text-white rounded-lg">Cancel Booking</button>
                                </Link>
                             </div>
                         </div>
                    </div>
                </div>

                
              </div>
            </div>
          </div>
        </div>
      </div>      
    </AppLayout>
  </div>
</template>

<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, reactive, watch } from "vue";
import {
  Dialog,
  DialogOverlay,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import {
  UserGroupIcon,
  MenuIcon,
  BanIcon,
  BadgeCheckIcon,
  EyeIcon,
  QuestionMarkCircleIcon,
  CollectionIcon,
  TrashIcon,
  ExclamationIcon,
  SearchIcon,
  PencilAltIcon,
} from "@heroicons/vue/outline";
export default {
 
  name: "My Bookings",
  components: {
    Link,
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    ExclamationIcon,
    AppLayout,
    EyeIcon
  },
  props: {
    my_bookings: Object,
  },
  setup(props) {
    var choosenorder = [];
    var currentRoute = window.location.pathname;
    const open = ref(false);
    const opencancel = ref(false);
    const order_id = ref(null);
    function openModel(id) {
      order_id.value = id;
      open.value = true;
    }
    function cancelOrderModal(id) {
      order_id.value = id;
      opencancel.value = true;
    }
    function cancelOrder() {
      Inertia.put(
        route("order.update.cancel", order_id.value),
        {
          orderid: order_id.value,
          preserveState: true,
          preserveScroll: true,
        },
        {
          onSuccess: (page) => {
            opencancel.value = false;
          },
        }
      );
    }
    
    return {
      currentRoute,
      choosenorder,
      open,
      opencancel,
      openModel,
      cancelOrderModal,
      cancelOrder,

    };
  },
};
</script>

<style></style>