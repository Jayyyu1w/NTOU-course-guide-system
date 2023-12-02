<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'

const router = useRouter()

const course_info = ref([])
const grade_1 = ref([])
const grade_2 = ref([])
const grade_3 = ref([])
const grade_4 = ref([])
const display_course = ref([])
const no_course = ref(false)
const keyword = ref("")

const searching = (() => {
	display_course.value = [];
	for (let item of course_info) {
		if (keyword == "") {
			display_course.push(item);
		} else if (item.name.search(keyword) != -1) {
			display_course.push(item);
		}
	}
	console.log(display_course);
});

axios.get("https://database--project.000webhostapp.com/course.php")
	.then((res) => {
		course_info.value = res.data;
		console.log('course_info', course_info.value);
		for (let item of course_info.value) {
			if (item.grade == 1)
				grade_1.value.push(item);
			if (item.grade == 2)
				grade_2.value.push(item);
			if (item.grade == 3)
				grade_3.value.push(item);
			if (item.grade == 4)
				grade_4.value.push(item);
		}
		display_course.value = grade_1.value;
		console.log('grade_1', grade_1.value);
		console.log('grade_2', grade_2.value);
		console.log('grade_3', grade_3.value);
		console.log('grade_4', grade_4.value);
	})
</script>

<template>
	<div class="container my-5" id="courses">
		<div class="text-center">
			<h3 class="fw-bolder">所有課程</h3>
		</div>
		<div class="row mt-3">
			<div class="col-md-8">
				<form class="d-flex round-top">
					<input class="form-control me-2" type="search" placeholder="keyword" v-model="keyword"
						aria-label="Search">
					<button class="btn btn-outline-success" type="button" @click="searching">search</button>
				</form>
			</div>
			<span class="radio_group col-md-4 mt-2">
				<span class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="radiobutton" id="grade1" :value="display_course"
						@input="display_course = grade_1" checked>
					<label class="form-check-label" for="grade1">
						大一
					</label>
				</span>
				<span class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="radiobutton" id="grade2" :value="display_course"
						@input="display_course = grade_2">
					<label class="form-check-label" for="grade2">
						大二
					</label>
				</span>
				<span class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="radiobutton" id="grade3" :value="display_course"
						@input="display_course = grade_3">
					<label class="form-check-label" for="grade3">
						大三
					</label>
				</span>
				<span class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="radiobutton" id="grade4" :value="display_course"
						@input="display_course = grade_4">
					<label class="form-check-label" for="grade4">
						大四
					</label>
				</span>
			</span>
		</div>
		<div class="mt-4">
			<ul class="list-group course_style" id="course_list">
				<div v-for="dis of display_course">
					<RouterLink :to="{
						path: `/course/info/${dis.course_ID}`,
						query: { course_ID: dis.course_ID, class: dis.class }}">
						<li class="list-group-item" v-if="dis != undefined">
							<div class="col">
								<div class="row-md-8 pt-2">
									<p>
										<span class="h4">
											{{ dis.name }}
										</span>
										<span class="semester">
											{{ dis.semester }}
										</span>
									</p>
								</div>
								<div class="row-md-4">
									<div>課號：{{ dis.course_ID }}</div>
									<div>資訊工程學系&nbsp;&nbsp;&nbsp;{{ dis.grade }}&nbsp;&nbsp;&nbsp;{{ dis.class }}
									</div>
									<div>
										學分數：{{ dis.credit }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										授課教師：{{ dis.teacher }}
									</div>
								</div>
							</div>
						</li>
					</RouterLink>
				</div>
			</ul>
		</div>
	</div>
</template>

<style scoped>
.course_style {
	font-size: 16px;
}

#course_list li {
	height: auto;
}

.semester {
	float: right;
}

.filter {
	border-style: initial;
	border-width: thick;
}

.title {
	font-size: 32px;
	text-align: center;
	font-weight: bold;
	margin-bottom: 3%;
}
</style>