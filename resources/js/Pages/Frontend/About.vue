<template>
    <div>
        <Head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>About</title>
        </Head>
        <AppLayout>
            <!-- Confiction -->
            <section class="my-10 max-w-7xl mx-auto grid grid-cols-12 gap-3 px-3">
                <div class="col-span-12 md:col-span-5 my-auto">
                    <div class="relative w-[300px] h-[250px] lg:w-[350px] lg:h-[300px] mx-auto">
                        <div class="w-full h-full absolute left-0 top-0 z-10 rounded-tl-2xl overflow-hidden">
                            <img src="/images/about_1.png" class="w-full h-full object-cover" alt="about">
                        </div>
                        <div class="hidden lg:inline-block w-[330px] h-[270px] absolute left-10 top-12 bg-[#D1127C] rounded-br-2xl"></div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-7 py-10">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-lg pb-1 text-start">Our Confiction</h3>
                    <p class="py-3">When our students are encouraged to express themselves freely, without limitations, that is when they discover their unique creativity. When they are open to new ideas, experiences, and important lessons, they can create anything in their lives.</p>
                </div>
            </section>
            <section class="my-10 max-w-7xl mx-auto grid grid-cols-12 gap-3 px-3">
                <div class="col-span-12 md:col-span-7 py-10">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-lg pb-1 text-start">Mission Statement</h3>
                    <!-- <h1 class="playfair_custom font-medium text-lg text-center">Lorem ipsum dolor sit amet, csecteturiscing</h1> -->
                    <p class="py-3">The Art Studio of Lake Mary School of Art will provide a creative and positive environment for all students to learn, to express, and to expand their artistic talents and skills to become more accomplished, confident artists in their lives.</p>
                </div>
                <div class="col-span-12 md:col-span-5 my-auto">
                    <div class="relative w-[300px] h-[250px] lg:w-[350px] lg:h-[300px] mx-auto">
                        <div class="hidden lg:inline-block w-[330px] h-[280px] absolute left-10 top-0 bg-[#D1127C] rounded-tr-2xl"></div>
                        <div class="w-full h-full absolute right-0 top-5 z-10 rounded-bl-2xl overflow-hidden">
                            <img src="/images/about_1.png" class="w-full h-full object-cover" alt="about">
                        </div>
                    </div>
                </div>        
            </section>
            <section class="bg-[rgba(211,234,245,0.7)] py-5 px-3">
                <div class="my-10 max-w-7xl mx-auto flex flex-col justify-center items-center">
                    <h3 class="playfair_custom font-medium text-[#D1127C] italic text-lg pb-1">About Our School</h3>
                    <!-- <h1 class="playfair_custom font-medium text-2xl text-center">Lorem ipsum dolor sit amet, consec ipsum dolor sit amet, conse dolor </h1> -->
                    <p class="py-3 text-[rgba(0,0,0,0.57)] text-center">Located in the heart of Lake Mary and founded in 2001 by Stella Tagliavore in the spirit of bringing the "Arts" to our community, The School of Art provides art education to children and adults of all ages. Occupying more that 2000 square feet of classrooms, students have an opportunity to explore a multitude of arts including drawing, painting, cartooning, sculpting, pottery, sewing, and cooking. Founder Stella Tagliavore, who instructs using a hands-on approach, is an accomplished educator who boasts more than 30 years of experience in the field of education. Having experience in a variety of subjects, Ms. Stella believes that when students are given the opportunity to develop their artistic skills and talents, they become better problem solvers and develop a high sense of self-esteem that they will use throughout their lives. Our classes focus on building fundamental beliefs, skills, and individualities, as well as the important lessons and techniques that provide a solid foundation in the field of art education.</p>
                </div>

                <div class="my-10 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-3 bg-white p-3">
                    <div class="h-60 md:h-64 lg:h-72 col-span-1 rounded-tl-xl rounded-br-xl overflow-hidden">
                        <img src="/images/about_img.png" alt="about_img" class="h-full w-full object-cover" srcset="">
                    </div>
                    <div class="h-60 md:h-64 lg:h-72 col-span-1 rounded-tl-xl rounded-br-xl overflow-hidden">
                        <img src="/images/about_img2.png" alt="about_img" class="h-full w-full object-cover" srcset="">
                    </div>
                    <div class="h-60 md:h-64 lg:h-72 col-span-1 rounded-tl-xl rounded-br-xl overflow-hidden">
                        <img src="/images/about_img3.png" alt="about_img" class="h-full w-full object-cover" srcset="">
                    </div>
                </div>
            </section>    
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue";
import {Head} from "@inertiajs/inertia-vue3"
export default{
    name: 'about',
    components:{
        AppLayout,
        Head
    }
}
</script>

<style scoped>
.playfair_custom {    
  font-family: "Playfair Display", serif;
}
</style>