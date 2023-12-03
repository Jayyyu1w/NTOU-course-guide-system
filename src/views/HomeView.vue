<script setup>
import Navbar from '@/components/navbar.vue'
</script>

<template>
	<Navbar />
	<RouterView :key="$route.fullPath" />
</template>

<style scoped>
</style>