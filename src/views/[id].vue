<script setup>
	import { useRoute } from 'vue-router';

	const route = useRoute();
	console.log(route.path);
</script>

<template>
	<div>
		<h1>hello!</h1>
	</div>
</template>
