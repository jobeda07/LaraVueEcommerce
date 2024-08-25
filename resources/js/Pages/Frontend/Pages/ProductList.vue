<template>
    <div>
        <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest Product List</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="(product,index) in products.data" :key="index" class="group relative">
                      <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img v-if="product.productAllImages && product.productAllImages.length > 0"
                                :src="product.productAllImages[0].image"
                                :alt="product.imageAlt"
                                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                            <img v-else
                                src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg"
                                :alt="product.imageAlt"
                                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                        </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="">
                                    <span aria-hidden="true" class="absolute inset-0" />
                                    {{ product.name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script setup>
defineProps({
    products: Array
})
</script>
<style lang="">

</style>
