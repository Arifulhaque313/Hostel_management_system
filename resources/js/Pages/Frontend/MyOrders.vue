<template>
  <div>
    <Head>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>My Orders</title>
    </Head>
    <AppLayout>
      <div class="px-4 py-5 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
          <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
              <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Order Id</th>
                      <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                      <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                      <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                      <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only"><EyeIcon /></span>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="person in people" :key="person.email">
                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ person.name }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ person.title }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ person.email }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ person.role }}</td>
                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900"
                          ><span class="sr-only"><EyeIcon /></span></a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
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

const people = [
  { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
  // More people...
]

export default {
  mounted() {
    window.setTimeout(
      "document.getElementById('successMessage').style.display='none';",
      5000
    );
  },
  name: "MyOrders",
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
    orders: Array,
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
    function selectedOrder() {
      return props.orders.find((d) => d.id === currentRoute);
      console.log("HHHHHHHHHHHHHHHHHHHHH");
    }
    console.log(selectedOrder);

    return {
      currentRoute,
      choosenorder,
      open,
      opencancel,
      openModel,
      cancelOrderModal,
      cancelOrder,
      selectedOrder,
    };
  },
  data() {
    return {
        people
    }
  },

  methods: {
    orderDetails(order) {
      this.currentRoute = order.id;
      this.loading = true;
      this.$inertia
        .visit(route("order.index", order.id), {
          replace: true,
          preserveState: true,
          preserveScroll: true,
        })
        .then(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style></style>