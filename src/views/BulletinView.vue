<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import navbar from '../components/head.vue';

const router = useRouter();
//counter
const counter = ref(1.0);
function countdown(){
	counter.value--;
	if(counter.value == 0){
		router.push('/bulletin/main');
	}
}
onMounted(() => {
	setInterval(countdown, 100);
});

</script>

<template>
	<navbar />
</template>

<style>
</style>
