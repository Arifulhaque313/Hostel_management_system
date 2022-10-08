<template>
<!-- newsletter -->
  <div>
    <section class="bg-[#D1127C] pt-3 px-3">
      <div class="max-w-7xl mx-auto flex flex-row justify-between">
        <div class="hidden md:block">
          <img
          src="/images/newsletter.png"
          alt=""
          class="mt-[105px]"
          />
        </div>
        <div class="py-5 md:py-20 flex flex-col md:flex-row gap-4 w-full justify-center md:justify-end items-center ">
          <p class="playfair_custom font-semibold text-2xl text-white">
            Newsletter to get in touch
          </p>
          <div class="relative">
            <p v-if="form.errors.email" class="absolute -top-7 md:-top-9 left-0 text-sm items-center justify-center p-2  text-white ">{{ form.errors.email }}</p>

            <div class="relative w-72 md:w-96 rounded-[50px] bg-white overflow-hidden flex justify-between items-center">
              <div>
                <input
                type="text"
                placeholder="Your email"
                class="border-hidden w-full pl-5 pr-32"  v-model="form.email"
              />
              </div>
            

              <button
                class="absolute top-0 right-0 bg-[#181818] px-6 py-2 text-white rounded-[50px]"
              @click="onSubmit">
                Subscribe
              </button>
            </div>

          </div>
        </div>
          
      </div>
      
      
    </section>

    <section class="bg-[#222222] text-white">
      <div class="max-w-7xl mx-auto py-5 grid grid-cols-3 md:grid-cols-5 gap-2 px-3">
        <div class="col-span-1 flex flex-col text-xs sm:text-sm md:text-base">
          <h1 class="playfair_custom font-normal my-6 text-lg">About</h1>
          <Link href="/contact" class="my-2 text-sm">Contact</Link>
          <Link href="/about" class="my-2 text-sm">About us</Link>
        </div>
        <div class="col-span-1 flex flex-col text-xs sm:text-sm md:text-base">
          <h1 class="playfair_custom font-normal my-6 text-xl">Service</h1>
          <Link href="/" class="my-2 text-sm">Art</Link>
          <Link href="/studentRegister" class="my-3 text-sm">Registration Form</Link>
        </div>
        <div class="col-span-1 flex flex-col text-xs sm:text-sm md:text-base">
          <h1 class="playfair_custom font-normal my-6 text-xl">Support</h1>
          <Link href="/policies" class="my-3 text-sm">Policy</Link>
          <Link href="/" class="my-2 text-sm">Contact Support</Link>
        </div>
        <div class="col-span-3 md:col-span-2 flex flex-col md:justify-center">
          <div class="flex flex-col gap-2 text-sm"> 
            <p>
                          
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum quasi delectus, beatae libero dicta quis repellat corrupti, laudantium perferendis, quas molestiae saepe autem!

          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam asperiores amet quisquam commodi odio tempore corporis sapiente quas consectetur.

          </p>
          <!-- <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et
            consectetur adipiscing elit. Et.
          </p> -->
          </div>
        </div>
      </div>
      <div class="w-full h-[2px] bg-[#373636]"></div>
      <div class="max-w-7xl mx-auto flex justify-center">
        <p class="my-4 px-3 text-xs">
          Copyright &copy; 2022
          <span class="text-[#D1127C]">Hostel Lagbe</span> All Rights Reserved
        </p>
      </div>
    </section>
  </div>
</template>

<script setup>

import {Link, Head, useForm} from "@inertiajs/inertia-vue3"



  // const show = ()=>{
  //   alert("Ariful Islam");
  // }
  const form = useForm({
      email: null,
  });

  const onSubmit = () => {
            // console.log(form.email)
            form.post(route('newsletter.store'),{
                preserveScroll: true,
                onSuccess: () => {
                    form.reset('email')
                   
                },
            });
        }


</script>

<style scoped>
.playfair_custom {
  font-family: "Playfair Display", serif;
}
</style>