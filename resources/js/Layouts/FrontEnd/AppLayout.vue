<template>
    <div class="max-h-screen max-w-full overflow-x-hidden">
        <Notification />
        <Header></Header>
        <slot></slot>
        <Footer></Footer>
    </div>
</template>
<script>                            
import Header from "./Shared/Header.vue"
import Footer from "./Shared/Footer.vue"
import Notification from "../../Components/Notification.vue"
    export default{
        components:{
            Header,
            Footer,
            Notification,
        },
        setup(){}
    }
</script>

<style>
template, button, input, optgroup, select, textarea{
    font-family: 'Nunito', sans-serif;
}
.background{
    background: url('/images/bgartstudio.png') no-repeat; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.blog_bg {
  background: url("/images/background_blog.png");
}
.playfair_custom {    
  font-family: "Playfair Display", serif;
}

.hero_bg{
   background: url('/images/bg.svg') no-repeat; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; 
}
</style>