<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

const submit = reactive({
	title: "",
	content: "",
	//course_ID: 1,
	class: 'A',
	class_name: "",
	//sender: "",
	receiver: "",
	time: "",
	bulletin_ID: ""
});

const click = (() => {
	let yy = new Date().getFullYear();
	let mm = new Date().getMonth() + 1;
	let dd = new Date().getDate();
	let hh = new Date().getHours();
	let mf = new Date().getMinutes() < 10 ? '0' + new Date().getMinutes() : new Date().getMinutes();
	let ss = new Date().getSeconds() < 10 ? '0' + new Date().getSeconds() : new Date().getSeconds();
	submit.time = yy + '-' + mm + '-' + dd + ' ' + hh + ':' + mf + ':' + ss;
	var out = JSON.stringify(submit);
	console.log(out);
	var links = "https://database--project.000webhostapp.com/bulletin_add.php";
	axios.post(links, out).then((res) => {
		console.log(res);
		//router.replace({ path: '/course/info/' + class_ID.value, query: { course_ID: class_ID.value, class: classes.value }});
	});
})

onMounted(() => {
	axios.get("https://database--project.000webhostapp.com/bulletin.php")
		.then((res) => {
			let ret = res.data;
			console.log(ret);
		});
})
</script>

<template>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col">
			<form :model="submit">
				<div class="mb-1">
					<label class="form-label">標題</label>
					<input type="text" class="form-control" v-model="submit.title" aria-describedby="title_help">
					<div id="title_help" class="form-text">請輸入公告標題</div>
				</div>
				<div class="mb-3">
					<label class="form-label">課程名稱</label>
					<select class="form-select" aria-label="Default select example" v-model="submit.class_name">
						<option selected></option>
						<option v-bind:value="course.name" v-for="course in courses">{{ course.name }}</option>
					</select>
					<div id="class_help" class="form-text">請選擇課程名稱</div>
				</div>
				<div class="mb-3">
					<label class="form-label">班級</label>
					<select class="form-select" aria-label="Default select example" v-model="submit.class">
						<option selected></option>
						<option value="A">A</option>
						<option value="B">B</option>
					</select>
					<div id="class_id_help" class="form-text">請選擇班級</div>
				</div>
				<!-- <div class="mb-3">
                    <label class="form-label">發布者</label>
                    <input type="text" class="form-control" ref="sender" aria-describedby="sender_help">
                    <div id="sender_help" class="form-text">請輸入發布者</div>
                </div> -->
				<div class="mb-3">
					<label class="form-label">接收對象</label>
					<input type="text" class="form-control" v-model="submit.receiver" aria-describedby="receiver_help">
					<div id="receiver_help" class="form-text">請輸入接收對象</div>
				</div>
				<div class="mb-3">
					<label class="form-label">內容</label>
					<textarea class="form-control" v-model="submit.content" rows="10" aria-describedby="content_help"></textarea>
					<div id="content_help" class="form-text">請輸入內容</div>
				</div>
			</form>
			<button style="float:right;" @click="click">送出</button>
		</div>
		<div class="col-md-2"></div>
	</div>
</template>

<style></style>