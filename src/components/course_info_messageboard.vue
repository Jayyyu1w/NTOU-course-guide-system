<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const course_ID = ref("");
const course = ref("");
const curPicture = ref("");
const mess_info = ref([]);
const imgs = ['mark (1).png', 'mark (2).png', 'mark (3).png', 'mark (4).png', 'mark (5).png', 'mark (6).png', 'mark (7).png', 'mark (8).png', 'mark (9).png']

const getPicture = () => {
	var idx = Math.floor(Math.random() * 9);
	return "https://database--project.000webhostapp.com/img/" + imgs[idx];
};

onMounted(() => {
	let getUrlString = location.href;
	let url = new URL(getUrlString);
	course_ID.value = url.searchParams.get('course_ID');
	course.value = url.searchParams.get('class');
	let links = "https://database--project.000webhostapp.com/get_message.php?course_ID=" + course_ID.value;
	axios.get(links) //發出http請求
		.then((res) => {
			console.log(res.data);
			mess_info.value = res.data;
		})
})
</script>

<template>
	<div class="container my-5">
		<div v-for="mess of mess_info">
			<div class="card col-md-8">
				<div class="row">
					<div class="col-2">
						<img v-bind:src="getPicture()" width="70" class="rounded-circle mt-2">
					</div>
					<div class="col-10">
						<div class="rating" style="float:left;">
							<div v-if="mess.hot >= 5"><label for="5" class="display">☆</label></div>
							<div v-else><label for="5" class="no_display">☆</label></div>

							<div v-if="mess.hot >= 4"><label for="4" class="display">☆</label></div>
							<div v-else><label for="4" class="no_display">☆</label></div>

							<div v-if="mess.hot >= 3"><label for="3" class="display">☆</label></div>
							<div v-else><label for="3" class="no_display">☆</label></div>

							<div v-if="mess.hot >= 2"><label for="2" class="display">☆</label></div>
							<div v-else><label for="2" class="no_display">☆</label></div>

							<div v-if="mess.hot >= 1"><label for="1" class="display">☆</label></div>
							<div v-else><label for="1" class="no_display">☆</label></div>
						</div>
						<h6>&nbsp&nbsp{{ mess.time }}</h6>
						<br>

						<div>
							{{ mess.text }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
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