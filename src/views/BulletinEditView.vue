<script setup>
import navbars from '../components/head.vue'
import bulletin_edit from '../components/bulletin_edit.vue'
</script>

<template>
	<navbars></navbars>
	<div id="fixpos"></div>
	<section id="bulletin_edit">
		<div class="row mt-5">
			<div class="text-center">
				<h3 class="fw-bolder">編輯公告</h3>
			</div>
			<bulletin_edit></bulletin_edit>
		</div>
	</section>
</template>

<style>

</style>