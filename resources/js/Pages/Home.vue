<template lang="">
    <Layout>
        <!-- Hero Start -->
        <Hero/>
        <!-- Hero End -->
        <!-- product start -->
        <ProductList/>
        <!-- product end -->
        <!-- footer -->
        <Footer/>
    </Layout>
</template>

<script setup>
import {
    onMounted
} from "vue";
import {
    initFlowbite
} from "flowbite";
onMounted(() => {
    initFlowbite();
});
import ProductList from "./Frontend/Pages/ProductList.vue";
import Hero from "./Frontend/Pages/Hero.vue";
import Layout from "./Frontend/Layout.vue";

</script>

<style lang="">

</style>
