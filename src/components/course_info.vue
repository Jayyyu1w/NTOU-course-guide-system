<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import MdEditor from 'md-editor-v3'
import 'md-editor-v3/lib/style.css'
import '@vavt/md-editor-extension/dist/previewTheme/arknights.css';
import ZH_TW from '@vavt/md-editor-extension/dist/locale/zh-TW';

MdEditor.config({
	editorConfig: {
		languageUserDefined: {
			'zh-TW': ZH_TW,
		},
	},
});

const router = useRouter();
const text = ref('');
const class_ID = ref("");
const course_class = ref("");
const class_name = ref("");
const star = ref(0);
const authorization = ref(0);
const getUrlString = location.href;
const url = new URL(getUrlString);

class_ID.value = url.searchParams.get('course_ID');
course_class.value = url.searchParams.get('class');

const links = "https://database--project.000webhostapp.com/get_information.php?course_ID=" + class_ID.value + "&class=" + course_class.value;
const links2 = "https://database--project.000webhostapp.com/get_hot_avg.php?course_ID=" + class_ID.value + "&class=" + course_class.value;
axios.get(links).then((res) => {
	console.log('res',res.data);
	let info = res.data;
	info = info[0]
	text.value = info['information'];
	class_name.value = info['name'];
	authorization.value = window.sessionStorage.getItem('authorization');
	console.log(authorization.value);
})
axios.get(links2).then((res) => {
		var avg = res.data[0].avg;
		star.value = avg;
		console.log(avg);
	}).catch((err) => {
		console.log(err);
	})
const getAvg = () => {
	var avg = star / 1;
	star.value = (avg * 1).toFixed(2);
	return "star" + star;
}
const edit = () => {
	router.push({ path: '/course/info/' + this.class_ID + '/edit', query: { course_ID: this.class_ID, class: this.class } });
	//course_ID=' + this.class_ID + "&class=" + this.class;
}
const clickYes = () => {
	document.getElementById('textDisplay').innerHTML = "<h4 class='fw-bolder'>感謝您的喜歡</h4>";
}
const clickNo = () => {
	document.getElementById('textDisplay').innerHTML = "<h4 class='fw-bolder'>感謝您的回覆<br>我們會持續改進</h4>";
}
</script>

<template>
	<section id="class_info">
		<div class="container d-flex justify-content-center my-5">
			<div class="row">
				<div class="col-md-12">
					<div id="class_name" class="border_style info_text_style">
						{{ class_name }}
					</div>
				</div>
			</div>
		</div>
		<div class="container my-5">
			<div class="row-md-12">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8">
							<div class="container border">
								<div class="row h-100 pr-4 pt-3 mb-4">
									<div class="text-dark fw-bold cinfo">
										課程資訊
									</div>
								</div>
								<div v-if="this.authorization == 1">
									<div class="text-center">
										<button type="button" class="btn btn-secondary" @click="edit"
											style="float:center">編輯課程</button>
									</div>
								</div>
								<div id="md-editor" class="container">
									<md-editor language="zh-TW" v-model="text" preview-only="true"
										:toolbarsExclude="toolbarsExclude" maxLength=5000 />
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="container border">
								<div class="pr-4 pt-3 mb-4">
									<div class="text-dark fw-bold fs-4">
										<h4 class="fw-bolder" style="float:left;">你喜歡我們的頁面嗎?</h4>
									</div>
									<br>
									<br>
									<div class="row" id="textDisplay">
										<div class="col-md-1">
											<button type="button" class="btn btn-success" id="yes"
												@click="clickYes">是</button>
										</div>
										<div class="offset-md-2 col-md-1">
											<button type="button" class="btn btn-danger" id="no" @click="clickNo">否</button>
										</div>
									</div>
								</div>
								<br>
								<div class="pr-4 pt-3 mb-4">
									<div class="text-dark fw-bold fs-4">
										<h4 class="fw-bolder" style="float:left;" v-bind:id="getAvg()">
											學生評價:&nbsp&nbsp{{ star }}&nbsp&nbsp</h4>
										<div class="rating" style="float:left;">
											<div v-if="star >= 5"><label for="5" class="display">☆</label></div>
											<div v-else><label for="5" class="no_display">☆</label></div>

											<div v-if="star >= 4"><label for="4" class="display">☆</label></div>
											<div v-else><label for="4" class="no_display">☆</label></div>

											<div v-if="star >= 3"><label for="3" class="display">☆</label></div>
											<div v-else><label for="3" class="no_display">☆</label></div>

											<div v-if="star >= 2"><label for="2" class="display">☆</label></div>
											<div v-else><label for="2" class="no_display">☆</label></div>

											<div v-if="star >= 1"><label for="1" class="display">☆</label></div>
											<div v-else><label for="1" class="no_display">☆</label></div>
										</div>
										<img style="width: 100px;"
											src="https://memeprod.ap-south-1.linodeobjects.com/user-template/8d0254d3eec4d41136f8604c25f60f56.png">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<style>
.cinfo {
	font-size: 36px;
	text-align: center;
}

.border_style {
	border-style: double;
	border-radius: 5px;
}

.info_text_style {
	font-size: 28px;
	font-weight: bold;
	padding: 10px 40px 10px 40px;
}

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