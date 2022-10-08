<template>
<div class="top-0 left-0 w-full h-full"></div>
    <AppLayout class="">
        <section class="blog_bg">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-10">
                
                <div class="col-span-1 md:col-span-12 order-2 md:order-1 flex flex-col px-4 md:px-28 py-8">
                    <div class="h-40 sm:h-48 md:h-64 lg:h-96 rounded-tl-3xl rounded-tr-3xl overflow-hidden">
                        <img :src="blog.thumbnail" class="h-full w-full object-fill" alt="">
                    </div>
                    
                    <!-- artist section and social media icon start -->
                    <div class="flex justify-between py-4">
                        <div class="my-2 flex gap-5">
                            <div class="flex gap-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_298_2168)">
                                    <path d="M18.3333 15.8333C18.3333 16.2754 18.1577 16.6993 17.8451 17.0118C17.5325 17.3244 17.1086 17.5 16.6666 17.5H3.33326C2.89123 17.5 2.46731 17.3244 2.15475 17.0118C1.84219 16.6993 1.6666 16.2754 1.6666 15.8333V4.16667C1.6666 3.72464 1.84219 3.30072 2.15475 2.98816C2.46731 2.67559 2.89123 2.5 3.33326 2.5H7.49993L9.1666 5H16.6666C17.1086 5 17.5325 5.17559 17.8451 5.48816C18.1577 5.80072 18.3333 6.22464 18.3333 6.66667V15.8333Z" stroke="#D1127C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.08325 9.16663H18.3333" stroke="#D1127C" stroke-width="2"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_298_2168">
                                    <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                                    <p class="text-[rgba(0,0,0,0.45)]">{{blog.author}}</p>

                            </div>
                            <div class="flex gap-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8333 3.33337H4.16661C3.24613 3.33337 2.49994 4.07957 2.49994 5.00004V16.6667C2.49994 17.5872 3.24613 18.3334 4.16661 18.3334H15.8333C16.7537 18.3334 17.4999 17.5872 17.4999 16.6667V5.00004C17.4999 4.07957 16.7537 3.33337 15.8333 3.33337Z" stroke="#E71489" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.3333 1.66663V4.99996" stroke="#E71489" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.66663 1.66663V4.99996" stroke="#E71489" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.49994 8.33337H17.4999" stroke="#E71489" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="text-[rgba(0,0,0,0.45)]">{{moment(blog.created_at).format('MMMM Do') +", "+moment(blog.created_at).format('YYYY') }} </p> 

                            </div>
                        </div>

                        <div class="flex gap-3">
                                <Link href="#!" class="cursor-pointer">
                                    <svg width="30" height="30" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_298_2174)">
                                        <path d="M24.6093 12.5C24.6093 5.81055 19.1894 0.390625 12.4999 0.390625C5.81049 0.390625 0.390564 5.81055 0.390564 12.5C0.390564 18.5439 4.81879 23.5537 10.6078 24.4629V16.0005H7.53168V12.5H10.6078V9.83203C10.6078 6.79736 12.4145 5.12109 15.1816 5.12109C16.5068 5.12109 17.8925 5.35742 17.8925 5.35742V8.33594H16.3652C14.8613 8.33594 14.392 9.26953 14.392 10.2271V12.5H17.7504L17.2133 16.0005H14.392V24.4629C20.1811 23.5537 24.6093 18.5439 24.6093 12.5Z" fill="black" fill-opacity="0.4"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_298_2174">
                                        <rect width="30" height="30" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                </Link>
                                <Link href="#!" class="cursor-pointer">
                                    <svg width="30" height="30" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="12.5" r="12.5" fill="black" fill-opacity="0.4"/>
                                        <g clip-path="url(#clip0_298_2176)">
                                        <path d="M19.458 9.44484C19.4676 9.57809 19.4676 9.71136 19.4676 9.8446C19.4676 13.9087 16.3743 18.5914 10.7207 18.5914C8.97899 18.5914 7.36098 18.087 5.99994 17.2114C6.24741 17.2399 6.48533 17.2494 6.74232 17.2494C8.17948 17.2494 9.50247 16.764 10.5589 15.936C9.20742 15.9074 8.0748 15.0223 7.68457 13.804C7.87494 13.8325 8.06528 13.8516 8.26517 13.8516C8.54118 13.8516 8.81721 13.8135 9.07418 13.7469C7.66555 13.4613 6.60905 12.224 6.60905 10.7297V10.6917C7.0183 10.9201 7.49423 11.0629 7.99863 11.0819C7.17058 10.5299 6.62809 9.58761 6.62809 8.52161C6.62809 7.95056 6.78035 7.42708 7.04686 6.97022C8.56019 8.8357 10.8349 10.054 13.3857 10.1872C13.3381 9.9588 13.3095 9.72088 13.3095 9.48293C13.3095 7.78875 14.6801 6.40869 16.3838 6.40869C17.2689 6.40869 18.0684 6.77988 18.63 7.3795C19.3247 7.24626 19.991 6.98927 20.5811 6.63712C20.3527 7.35097 19.8673 7.95059 19.2296 8.33127C19.8482 8.26468 20.4479 8.09332 20.9999 7.8554C20.5812 8.46451 20.0577 9.007 19.458 9.44484Z" fill="#F8F8F8"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_298_2176">
                                        <rect width="15" height="15" fill="white" transform="translate(5.99994 5)"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                </Link>
                                <Link href="#!" class="cursor-pointer">
                                    <svg width="30" height="30" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="12.5" r="12.5" fill="black" fill-opacity="0.4"/>
                                        <g clip-path="url(#clip0_298_2180)">
                                        <path d="M8.87533 18.1252H6.15424V9.3625H8.87533V18.1252ZM7.51332 8.16719C6.6432 8.16719 5.93744 7.44648 5.93744 6.57637C5.93744 6.15842 6.10347 5.75759 6.399 5.46205C6.69454 5.16652 7.09537 5.00049 7.51332 5.00049C7.93127 5.00049 8.3321 5.16652 8.62763 5.46205C8.92317 5.75759 9.0892 6.15842 9.0892 6.57637C9.0892 7.44648 8.38314 8.16719 7.51332 8.16719ZM19.0595 18.1252H16.3443V13.8596C16.3443 12.843 16.3238 11.5393 14.9295 11.5393C13.5148 11.5393 13.298 12.6438 13.298 13.7863V18.1252H10.5798V9.3625H13.1896V10.5578H13.2277C13.591 9.86934 14.4784 9.14277 15.8023 9.14277C18.5562 9.14277 19.0624 10.9563 19.0624 13.3117V18.1252H19.0595Z" fill="#F8F8F8"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_298_2180">
                                        <rect width="15" height="15" fill="white" transform="translate(4.99994 5)"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    <!-- artist section and social media icon end --> 

                    <div class="mt-8 mb-4">
                        <h1 class="playfair_custom font-semibold text-2xl">{{blog.title}}</h1>
                    </div>

                    <div class="my-4">
                        <p class="text-[rgba(0,0,0,0.4)] ">{{blog.description_field_one}}</p>
                    </div>


                    <div v-if="blog.description_field_two" class="my-4">
                        <p class="text-[rgba(0,0,0,0.4)] ">{{blog.description_field_two}}</p>
                    </div>


                    <div v-if="blog.description_field_three" class="my-4">
                        <p class="text-[rgba(0,0,0,0.4)] ">{{blog.description_field_three}}</p>
                    </div>


                    <div v-if="blog.description_field_four" class="my-4">
                        <p class="text-[rgba(0,0,0,0.4)] ">{{blog.description_field_four}}</p>
                    </div>

                    <div v-if="blog.images[0].path" class="mt-12 h-40 sm:h-48 md:h-64 lg:h-96 rounded-tl-3xl rounded-tr-3xl overflow-hidden">
                        <img :src="blog.images[0].path" class="h-full w-full object-fill" alt="">
                    </div>

                    <!-- comment form start  -->
                    <!-- <section class="mt-20">
                        <div>
                            <div>
                                <h1 class="playfair_custom font-semibold text-2xl">Leave your thought here</h1>
                            </div>
                            <div class="mt-8">
                                <form action="">
                                    <div>
                                        <textarea class="w-full bg-white rounded-xl shadow-xl border-1 border-blue-300 text-[rgba(0,0,0,0.4)] p-4" name="" id="" cols="30" rows="7" placeholder="Type your opinion"></textarea>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                            <div class="col-span-2 md:col-span-1">
                                                <input class="w-full bg-white rounded-xl shadow-xl border-1 border-blue-300 text-[rgba(0,0,0,0.4)] p-4" type="text" name="" id="" placeholder="Your name">
                                            </div>
                                            <div class="col-span-2 md:col-span-1">
                                                <input class="w-full bg-white rounded-xl shadow-xl border-1 border-blue-300 text-[rgba(0,0,0,0.4)] p-4" type="email" name="" id="" placeholder="Your email">
                                            </div>

                                    </div>

                                    <div class="mt-4">
                                        <button class="mt-15 px-8 py-2 bg-[#D1127C] hover:bg-transparent text-white hover:text-black border-[2px] border-[#D1127C] font-medium rounded-[50px]">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </section> -->

                    <!-- comment form end  -->


                </div>                
            </div>            
        </section>
    </AppLayout>
</template>
<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import PaginateFrontend from "@/Components/PaginateFrontend.vue";
import { ref } from "vue";
var moment = require("moment")

export default{
    name: 'about',
    components:{
        AppLayout,
        Link,
        PaginateFrontend
    },
    props:{
        blog: Object
    },
    setup(){
        const onSubmit = (e) => {
            // e.preventDefault();
            // console.log(111111111);
        }
        return{
            onSubmit,
            moment: moment,
        }
    }

}
</script>

<style scoped>

.background{
    background: url('/images/bgartstudio.png') no-repeat; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.playfair_custom {    
  font-family: "Playfair Display", serif;
}
</style>