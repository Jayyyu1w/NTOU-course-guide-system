<script setup>
import navbars from '../components/head.vue';
import couinf from '../components/course_info.vue';
import couinfmes from '../components/course_info_messageboard.vue';
import couinfmesadd from '../components/course_info_messageadd.vue';
</script>

<template>
	<navbars></navbars>
	<div id="fixpos"></div>
	<couinf></couinf>
	<section id="comment_board">
		<couinfmesadd></couinfmesadd>
		<couinfmes></couinfmes>
	</section>
</template>