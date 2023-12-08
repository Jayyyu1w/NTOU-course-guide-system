<script setup lang="ts">
import CourseInfo from '@/components/course_info.vue';
import CourseInfoMessageBoard from '@/components/course_info_messageboard.vue';
import CourseInfoMessageAdd from '@/components/course_info_messageadd.vue';
</script>

<template>
	<CourseInfo />
	<section id="comment_board">
		<CourseInfoMessageBoard />
		<CourseInfoMessageAdd />
	</section>
</template>