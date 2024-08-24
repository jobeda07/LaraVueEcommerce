<template lang="">
<!-- header -->
<Header/>
<!-- header end -->
<slot/>
<!-- footer -->

<Footer/>

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
import Header from "./Pages/Header.vue";
import Footer from "./Pages/Footer.vue";


</script>

<style lang="">

</style>
