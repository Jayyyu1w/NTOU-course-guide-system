<script setup lang="ts">
import axios from 'axios';
import { ref, inject,reactive } from 'vue';

const reload = inject('reload');
const submit = reactive({
	text: "",
	time: "",
	hot: 0
});
const getUrlString = location.href;
const url = new URL(getUrlString);
const class_ID = url.searchParams.get('course_ID');
const classes = url.searchParams.get('class');
const star = ref(0);
const sz = ref(0);
const isLogin = ref(window.sessionStorage.length);
const imgs = ['mark (1).png', 'mark (2).png', 'mark (3).png', 'mark (4).png', 'mark (5).png', 'mark (6).png', 'mark (7).png', 'mark (8).png', 'mark (9).png'];

const click = () => {
	let yy = new Date().getFullYear();
	let mm = new Date().getMonth() + 1;
	let dd = new Date().getDate();
	let hh = new Date().getHours();
	let mf = new Date().getMinutes() < 10 ? '0' + new Date().getMinutes() : new Date().getMinutes();
	let ss = new Date().getSeconds() < 10 ? '0' + new Date().getSeconds() : new Date().getSeconds();
	submit.text = refs.text.value;
	submit.hot = star.value;
	submit.time = yy + '-' + mm + '-' + dd + ' ' + hh + ':' + mf + ':' + ss;
	var out = JSON.stringify(submit);
	console.log(out);
	var links = "https://database--project.000webhostapp.com/message_add.php?course_ID=" + class_ID + "&class=" + classes;
	axios.post(links, out).then((res) => {
		console.log(res);
		reload();
		//router.replace({ path: '/course/info/' + class_ID.value, query: { course_ID: class_ID.value, class: classes.value }});
	});
};

const clickStar = (rate) => {
	star.value = rate;
};
</script>

<template>
	<div class="container my-5">
		<div class="row">
			<div class="col-md-12">
				<div class="card col-md-8">
					<div class="row">
						<div class="col-2">
							<img src="https://database--project.000webhostapp.com/img/mark (1).png" id="pic" width="70"
								class="rounded-circle mt-2">
						</div>
						<div class="col-10">
							<div class="comment-box ml-2">
								<h4>Add a comment</h4>
								<div class="rating">
									<input type="radio" name="rating" value="5" id="5"><label for="5"
										@click="clickStar(5)">☆</label>
									<input type="radio" name="rating" value="4" id="4"><label for="4"
										@click="clickStar(4)">☆</label>
									<input type="radio" name="rating" value="3" id="3"><label for="3"
										@click="clickStar(3)">☆</label>
									<input type="radio" name="rating" value="2" id="2"><label for="2"
										@click="clickStar(2)">☆</label>
									<input type="radio" name="rating" value="1" id="1"><label for="1"
										@click="clickStar(1)">☆</label>
								</div>
								<div class="comment-area">
									<textarea v-if="isLogin != 0" class="form-control" ref="text" placeholder="留下你的看法"
										rows="3"></textarea>
									<textarea v-else class="form-control" ref="text" placeholder="請登入以留言" rows="3"
										disabled></textarea>
								</div>
								<div class="comment-btns mt-2 float-right">
									<button v-if="isLogin != 0" class="btn btn-primary send btn-sm" @click="click">送出
										<i class="fa fa-long-arrow-right ml-1"></i>
									</button>
									<button v-else class="btn send btn-sm" disabled>送出
										<i class="fa fa-long-arrow-right ml-1"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</template>

<style>
#class_info .class_name {
	border: 2px solid #c0c0c0;
	width: 60%;
	margin: auto;
	padding: 15px 0;
	border-radius: 2px;
	position: relative;
}

.card {
	position: relative;
	display: flex;
	flex-direction: column;
	min-width: 0;
	padding: 20px;
	/*width: 450px;*/
	word-wrap: break-word;
	background-color: #fff;
	background-clip: border-box;
	border-radius: 3px;
	box-shadow: 0px 0px 2px 0px rgba(212, 182, 212, 1)
}

.comment-box {
	padding: 5px
}

.comment-area textarea {
	resize: none;
	border: 1px solid #ad9f9f
}

.form-control:focus {
	color: #495057;
	background-color: #fff;
	border-color: #ffffff;
	outline: 0;
	box-shadow: 0 0 0 1px rgb(255, 0, 0) !important
}

.send {
	color: #fff;
	background-color: #ff0000;
	border-color: #ff0000
}

.send:hover {
	color: #fff;
	background-color: #f50202;
	border-color: #f50202
}

.rating {
	display: flex;
	margin-top: -10px;
	flex-direction: row-reverse;
	margin-left: -4px;
	float: left
}

.rating>input {
	display: none
}

.rating>label {
	position: relative;
	width: 19px;
	font-size: 25px;
	color: #ff0000;
	cursor: pointer
}

.rating>label::before {
	content: "\2605";
	position: absolute;
	opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
	opacity: 1 !important
}

.rating>input:checked~label:before {
	opacity: 1
}

.rating:hover>input:checked~label:before {
	opacity: 0.4
}
</style>