<template lang="">
    <Layout>
       <div>
          <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>

    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
      <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
        <div class="space-y-6">
        <!-- cart product start -->
          <div v-for="product in products" :key="product.id"  class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
              <a  class="shrink-0 md:order-1">
                <img class="h-20 w-20 dark:hidden" v-if="product.productAllImages && product.productAllImages.length > 0"
                                :src="product.productAllImages[0].image"
                                :alt="product.imageAlt" />
                <img class="h-20 w-20 dark:hidden" v-else
                                src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg"
                                :alt="product.imageAlt" />
              </a>
              <label for="counter-input" class="sr-only">Choose quantity:</label>
              <div class="flex items-center justify-between md:order-3 md:justify-end">
              <!-- quantity cart -->
                <div class="flex items-center">
                  <button @click.prevent="updatecart(product,carts[getCartItem(product.id)].quantity - 1)"
                   :disabled="carts[getCartItem(product.id)].quantity <=1"
                   :class="[carts[getCartItem(product.id)].quantity >1 ? 'bg-white-100 cursor-pointer' :'bg-gray-100 cursor-not-allowed', 'inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 hover:bg-white-200 focus:outline-none focus:ring-2 focus:ring-white-100 dark:border-gray-600 dark:bg-white-700 dark:hover:bg-white-600 dark:focus:ring-white-700']">
                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                  </button>
                    <input type="text" readonly min="1" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                    v-model="carts[getCartItem(product.id)].quantity" />
                  <button @click.prevent="updatecart(product,carts[getCartItem(product.id)].quantity + 1)"    class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-white-100 hover:bg-white-200 focus:outline-none focus:ring-2 focus:ring-white-100 dark:border-gray-600 dark:bg-white-700 dark:hover:bg-white-600 dark:focus:ring-white-700">
                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                  </button>
                </div>
                <div class="text-end md:order-4 md:w-32">
                  <p class="text-base font-bold text-gray-900 dark:text-white">{{product.price}}</p>
                </div>
              </div>
              <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{product.name}}</a>

                <div class="flex items-center gap-4">
                  <button type="button" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                    </svg>
                    Add to Favorites
                  </button>

                  <button @click="remove(product.id)" type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
        <!-- cart product end -->
        </div>
      </div>

      <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
        <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
          <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

          <div class="space-y-4">
            <div class="space-y-2">
              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">SubTotal</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">{{total}}</dd>
              </dl>

              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Coupon</dt>
                <dd class="text-base font-medium text-green-600">0.00</dd>
              </dl>

              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                <dd class="text-base font-medium text-gray-900 dark:text-white">0.00</dd>
              </dl>
            </div>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
              <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
              <dd class="text-base font-bold text-gray-900 dark:text-white">8,191.00</dd>
            </dl>
          </div>

          <a href="#" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Checkout</a>

          <div class="flex items-center justify-center gap-2">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="#" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
              Continue Shopping
              <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
              </svg>
            </a>
          </div>
        </div>

        <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
          <form class="space-y-4">
            <div>
              <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Do you have a voucher or gift card? </label>
              <input type="text" id="voucher" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="" required />
            </div>
            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply Code</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
       </div>
    </Layout>
</template>

<script setup>
import { computed, onMounted} from "vue";
import {initFlowbite} from "flowbite";
import {usePage ,router} from "@inertiajs/vue3";
onMounted(() => {
    initFlowbite();
});
import Layout from "../Layout.vue";

// defineProps({
//     products: Array
// })
const carts = computed(() => usePage().props.cart.data.items);
//alert(carts);
const products = computed(() => usePage().props.cart.data.products);
const total = computed(() => usePage().props.cart.data.total);

const getCartItem = (productId) => carts.value.findIndex((item)=> item.product_id === productId);
const updatecart= (productId,quantity)=>{
    try{
        router.patch(route('cart.update',productId),{
            quantity:quantity,
            product:productId,
        });
        Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            showConfirmButton: false,
            title: ' Cart Update SuccessFully',
            timer: 1000,
        });
    }catch(err){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something Went Wrong.',
            timer: 1000,
        })
    }
}
const remove=(product)=>{
    try{
        router.delete(route('cart.delete',product));
        Swal.fire({
            toast: true,
            icon: "success",
            position: "top-end",
            showConfirmButton: false,
            title: ' Cart Item Delete SuccessFully',
            timer: 1000,
        });

    }catch(err){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something Went Wrong.',
            timer: 1000,
        })
    }
}

</script>

<style lang="">

</style>
