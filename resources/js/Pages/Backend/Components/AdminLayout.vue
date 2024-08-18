<template>
  <div class="antialiased bg-gray-50 dark:bg-gray-900">
   <!-- Navbar start -->
    <Navbar/>
   <!-- Navbar end -->

    <!-- Sidebar start-->
       <Sidebar/>
    <!-- Sidebar end-->

    <slot/>




  </div>
</template>
<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import { Head } from '@inertiajs/vue3';
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";

// initialize components based on data attribute selectors
onMounted(() => {
  initFlowbite();
});
</script>
