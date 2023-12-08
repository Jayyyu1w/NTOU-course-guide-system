<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { RouterView, RouterLink, useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const course_info = ref([]);
const hotSize = ref(3);
const curPage = ref(1);
const top_info = ref([]);

const changeWeb = (dis) => {
	router.push({ path: '/course/info/' + dis.course_ID, query: { course_ID: dis.course_ID, class: dis.class } });
};

axios.get("https://database--project.000webhostapp.com/get_hot.php") //發出http請求
	.then((res) => {
		course_info.value = res.data;
		console.log(res.data);
		top_info.value = course_info.value.slice((curPage.value * hotSize.value) - hotSize.value, (curPage.value * hotSize.value));
		top_info.value[0].star = top_info.value[0].hot.toFixed(2);
		top_info.value[1].star = top_info.value[1].hot.toFixed(2);
		top_info.value[2].star = top_info.value[2].hot.toFixed(2);
		console.log(top_info.value);
	})
</script>

<template>
	<div class="container">
		<ul class="list-group">
			<div v-for="course in top_info">
				<li class="list-group-item" @click="changeWeb(course)">
					<h3 class="fw-bolder">{{ course.name }}</h3>
					<h6>教師：{{ course.teacher }}</h6>
					<h6 class="fw-bolder" style="float:left;">{{ course.star }}&nbsp&nbsp&nbsp</h6>
					<div class="rating" style="float:left;">
						<div v-if="course.star >= 5"><label for="5" class="display">☆</label></div>
						<div v-else><label for="5" class="no_display">☆</label></div>

						<div v-if="course.star >= 4"><label for="4" class="display">☆</label></div>
						<div v-else><label for="4" class="no_display">☆</label></div>

						<div v-if="course.star >= 3"><label for="3" class="display">☆</label></div>
						<div v-else><label for="3" class="no_display">☆</label></div>

						<div v-if="course.star >= 2"><label for="2" class="display">☆</label></div>
						<div v-else><label for="2" class="no_display">☆</label></div>

						<div v-if="course.star >= 1"><label for="1" class="display">☆</label></div>
						<div v-else><label for="1" class="no_display">☆</label></div>
					</div>
					<h6 class="fw-bolder">&nbsp&nbsp({{ course.count }})</h6>
					<br>
				</li>
			</div>
		</ul>
		<div class="my-4">
			<a href="https://reurl.cc/Wq7la9" target="blank"><button type="button"
					class="btn btn-outline-primary">查看簡報</button></a>
		</div>
		<div class="row">
			<a href="https://cse.ntou.edu.tw/" target="_blank">
				<img src="@/assets/dian_zhi_da_lo.jpeg" style="width:300px">
			</a>
		</div>
	</div>
</template>

<style scoped>
.rating {
	display: flex;
	margin-top: -10px;
	flex-direction: row-reverse;
	margin-left: -4px;
	float: left
}

.rating>div>label {
	position: relative;
	width: 19px;
	font-size: 25px;
	color: #ffdd00;
	cursor: pointer
}

.display::before {
	content: "\2605";
	position: absolute;
	opacity: 1;
}

.no_display::before {
	content: "\2605";
	position: absolute;
	opacity: 0;
}
</style>