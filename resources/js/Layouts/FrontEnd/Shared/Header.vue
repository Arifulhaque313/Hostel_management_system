<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover class="relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="flex justify-between items-center border-b-2 border-gray-100 py-5 lg:justify-start lg:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <Link href="/">
            <span class="sr-only">Workflow</span>
            <!-- <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="" /> -->
            <!-- <img class="w-auto md:w-[11rem] h-10 md:h-[50px]" src="/images/logo.png" alt="" /> -->
            <p class="text-xl md:text-3xl font-normal md:font-bold text-pink-600">Hostel Lagbe</p>
          </Link>
        </div>
        <div class="-mr-2 -my-2 lg:hidden">
          <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Open menu</span>
            <MenuIcon class="h-6 w-6" aria-hidden="true" />
          </PopoverButton>
        </div>
        <PopoverGroup as="nav" class="hidden lg:flex space-x-6 pt-2">
          <div class="" v-for="item in menus" :key="item.name">
            <Link :href=item.href class="text-base font-medium text-gray-500 hover:text-gray-900"> {{ item.name }} </Link>
          </div>          
        </PopoverGroup>
        <div class="hidden lg:flex items-center justify-end lg:flex-1 lg:w-0 gap-3">
          
          
          <!-- User -->
          <div v-if="$page.props.user"  @click="toggleMenu" class="ml-auto flex items-center gap-2 flex justify-center items-center gap-2 w-auto ml-auto px-4 py-2 text-sm font-medium border border-gray-200 rounded-md hover:bg-opacity-30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 text-gray-700 cursor-pointer">
            
            <div class="ml-1 relative">
              <div>
                <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Open user menu</span>
                  <img v-if="$page.props.user.image != null" class="h-8 w-8 rounded-full" :src="$page.props.user.image" alt="" srcset="" />
                  <img v-else class="h-8 w-8 rounded-full" src="/images/Avatar.png" alt="" srcset="" />
                </button>
              </div>
              
              <!-- user admin profile button start  -->
              <div v-if="$page.props.user.role_id == 1"> 
                    <!-- for admin  -->
                    <div v-if="showMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                      <Link :href="route('app.profile.show', $page.props.user.id)" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</Link>
                      <Link :href="route('app.dashboard')" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Admin Panel</Link>
                      <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</Link>
                  </div>
              </div>

              <!-- for uesr  -->
              <div v-if="$page.props.user.role_id == 2">
                  <div v-if="showMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <Link :href="route('user.profile')" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</Link>
                    <Link :href="route('my.booking')" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">My Bookings</Link>
                    <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</Link>
                </div>
              </div>
              <!-- user admin profile button condition start  -->
            </div>
            <strong>{{ $page.props.user.name }}</strong>
          </div>
          <!-- User -->
           <Link  v-else href="/login" class="border-2 border-blue-700 text-blue-800 text-sm px-[22px] py-[6px] rounded-xl font-medium">Login</Link>
        </div>
        
              
      </div>
    </div>

    <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
      <PopoverPanel focus class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right lg:hidden">
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
          <div class="pt-5 pb-6 px-5">
            <div class="flex items-center justify-between">
              <div>
                <img class="h-8 w-auto sm:h-10" src="/images/logo.png" alt="" />
                
              </div>
              <div class="-mr-2">
                <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                  <span class="sr-only">Close menu</span>
                  <XIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
            <div class="mt-6">
              <nav class="grid gap-y-8">
                <a v-for="item in menus" :key="item.name" :href="item.href" class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                  <component :is="item.icon" class="flex-shrink-0 h-6 w-6 text-indigo-600" aria-hidden="true" />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    {{ item.name }}
                  </span>
                </a>
              </nav>
                <div class="flex justify-center gap-5 w-full mt-5">
                  <div v-if="$page.props.user">
                    <Link :href="route('user.profile')" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profile</Link>
                    <!-- <Link :href="route('app.profile.show', $page.props.user.id)" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Admin Panel</Link> -->
                    <Link :href="route('my.booking')" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">My Bookings</Link>
                    <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</Link>
                  </div>
                  <div v-else>
                   <Link href="/login" class="border-2 border-blue-700 text-blue-800 text-sm px-[22px] py-[6px] rounded-xl font-medium">Login</Link>

                  </div>
                </div>
            </div>            
          </div>
        </div>         
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverGroup, PopoverPanel } from '@headlessui/vue'
import {
  BookmarkAltIcon,
  CalendarIcon,
  ChartBarIcon,
  CursorClickIcon,
  MenuIcon,
  PhoneIcon,
  PlayIcon,
  RefreshIcon,
  ShieldCheckIcon,
  SupportIcon,
  ViewGridIcon,
  XIcon,
} from '@heroicons/vue/outline'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const menus = [
    {name: 'Home',href:"/"},
    {name: 'Hostel',href:"/hostels"},
    {name: 'Blog',href:"/blog"},
    {name: 'Contact',href:"/contact"},
    {name: 'About Us',href:"/about"},
]

const auth = ref(false)
const showMenu = ref(false)

const loginHandler = () => {
  auth.value = !auth.value
}

const menuHandler = () => {
  showMenu.value = !showMenu.value
}

const toggleMenu = () => {
			showMenu.value = !showMenu.value
		}

		const showSideBar = () => {
			emit("toggleSidebar")
			// console.log(emit, "From Emit")
		}

</script>