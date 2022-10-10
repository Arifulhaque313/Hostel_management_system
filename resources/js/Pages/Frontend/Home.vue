<template>
  <div>
    <Head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Home</title>
    </Head>
    <div>
      <AppLayout>
        <section class="relative bg-white ">
            <div class="max-w-7xl mx-auto px-4 md:px-12">
              <div class="grid grid-cols-12 gap-2 mt-20 py-10">
                
                  <div class="col-span-12 md:col-span-6 flex items-center justify-center">
                    <div class="">
                        <p class="text-3xl md:text-5xl font-bold">Find the Best <br> Hostel Around</p>
                        
                        <!-- filter section  -->
                        <div class="flex justify-center my-8 ">
                          <Link :href="route('hostels.index')">
                             <button class="px-6 py-1 text-xl rounded-full bg-pink-600 text-white">Find the one</button>
                          </Link>
                        </div>
                    </div>
                  </div>

                  <div class="col-span-12 md:col-span-6 h-full w-full">
                      <img class="h-full w-full object-cover rounded-xl" src="/images/hero_bg.svg" alt="">
                  </div>
              </div>
            </div>
        </section>

        <!-- fourth section +  start  -->
        <div class="max-w-full  h-auto bg-[#E5E5E5] hero_4th_bg pt-14 md:pt-8 pb-12">
            <div class="max-w-7xl mx-auto my-2 px-4">
                <!-- first carousel start  -->
                <div>
                    <p class="text-[#2B3065] text-2xl md:text-4xl font-bold my-4 md:my-4 flex justify-center">Checkout Our latest</p>
                    <carousel :settings="settings" :breakpoints="breakpoints">
                        <slide v-for="(hostel,index) in hostels" :key="index">
                            <div class="w-[500px] h-auto bg-white mx-12 my-12 rounded-xl shadow-xl">
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
                                      <p class="mt-1 font-bold">Address : {{hostel.address}}</p>
                                  </div>

                                  <div class="justify-center mt-4">
                                    <Link :href="route('hostels.show',hostel.id)">
                                        <button class="px-4 md:px-12 py-2 bg-pink-600 text-white font-bold rounded-full">
                                          More Details
                                        </button>
                                    </Link>
                                  </div>
                               </div>
                                
                              </div>
                                
                            </div>
                        </slide>

                        <template #addons>
                        <navigation />
                        </template>
                    </carousel>
                </div>
                <!-- first carousel end  -->
            </div>
        </div>
        <!-- fourth section end  -->
        
       
      </AppLayout>
    </div>
  </div>
</template>

<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
import { CheckIcon } from "@heroicons/vue/outline";
import { Link, Head } from '@inertiajs/inertia-vue3'
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';


export default {
  name: "home",
  components: {
    AppLayout,
    Carousel,
    Slide,
    Pagination,
    Navigation,
    CheckIcon,
    Link,
    Head
  },
  props:{
   hostels:Object,
  },
   data: () => ({
        // carousel settings
        settings: {
        itemsToShow: 1,
        snapAlign: 'center',
        },
        // breakpoints are mobile first
        // any settings not specified will fallback to the carousel settings
        breakpoints: {
            // 700px and up
            700: {
                itemsToShow: 1,
                snapAlign: 'center',
            },
            // 1024 and up
            1024: {
                itemsToShow: 3,
                snapAlign: 'start',
            },
        },
    }),
  methods:{
    hide(){
        this.$refs.notice.classList.add("hide");
    }
  },
  setup() {
    return {
      
    };
  },
};
</script>

<style scoped>
.bg_newsletter {
  background: url("/images/newsletter.png") no-repeat;
  /* -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; */
}

.hide{
  display: none;
  transition: display 2s;

}

.first_letter_capital::first-letter {
  text-transform: capitalize;
}

</style>
