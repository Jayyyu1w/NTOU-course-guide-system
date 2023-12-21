<script setup lang="ts">
import Navbar from '@/components/navigate_bar.vue'
</script>

<template>
	<Navbar />
	<RouterView :key="$route.fullPath" />
</template>

<style scoped>
</style>