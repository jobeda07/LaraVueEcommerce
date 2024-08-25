<template lang="">
    <Layout>
        <!-- Hero Start -->
        <Hero/>
        <!-- Hero End -->
        <!-- product start -->
        <ProductList :products="products" />
        <!-- product end -->
        <!-- footer -->
        <Footer/>
    </Layout>
</template>

<script setup>
import { onMounted} from "vue";
import {initFlowbite} from "flowbite";
onMounted(() => {
    initFlowbite();
});
import ProductList from "./Frontend/Components/ProductList.vue";
import Hero from "./Frontend/Pages/Hero.vue";
import Layout from "./Frontend/Layout.vue";

defineProps({
    products: Array
})
</script>

<style lang="">

</style>
