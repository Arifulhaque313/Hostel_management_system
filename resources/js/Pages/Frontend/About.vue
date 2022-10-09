<template>
    <div>
        <Head>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>About</title>
        </Head>
        <AppLayout>
            <!-- Confiction -->
            <section class="my-10 max-w-7xl mx-auto grid grid-cols-12 gap-3 px-3">
                <h1 class="text-center">About Us</h1>
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