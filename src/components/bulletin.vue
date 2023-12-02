<script setup>
import { ref, onMounted } from 'vue';
import { RouterView, RouterLink, useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const bulletin = ref([]);
const totBulletin = ref(0);
const pageSize = ref(10);
const curPage = ref(1);
const cut = ref([]);
const totPage = ref(0);
const authorization = ref(0);
const bulletin_ID = ref(0);
const userName = ref(window.sessionStorage.getItem('userName'));

const slice = ((cur) => {
	window.scrollTo(0, 0);
	console.log(cur);
	curPage.value = cur;
	cut.value = bulletin.value.slice((curPage.value * pageSize.value) - pageSize.value, (curPage.value * pageSize.value))
});

const del_bulletin = (() => {
	console.log("delete");
	let ret = JSON.stringify({ "bulletin_ID": bulletin_ID.value });
	axios.post("https://database--project.000webhostapp.com/bulletin_delete.php", ret)
		.then((res) => {
			console.log(res.data);
			if (res.data == "success") {
				alert("刪除成功");
				router.replace('/bulletin/main');
			}
			else {
				alert("刪除失敗");
			}
		})
})

onMounted(() => {
	axios.get("https://database--project.000webhostapp.com/bulletin.php")
		.then((res) => {
			bulletin.value = res.data;
			totBulletin.value = bulletin.value.length;
			for (let item of bulletin.value) {
				item.headid = "head" + item.bulletin_ID;
				item.bodyid = "body" + item.bulletin_ID;
				item.actbody = "#" + item.bodyid;
			}
			slice(1);
			totPage.value = Math.ceil(totBulletin.value / pageSize.value);
			console.log(totPage.value);
			authorization.value = window.sessionStorage.getItem('authorization');
			console.log(authorization.value);
		})
});
</script>

<template>
	<div class="container my-5">
		<div class="row">
			<div class="row">
				<div class="text-center">
					<h3 class="fw-bolder">所有公告</h3>
					<div v-if="this.authorization == 1">
						<RouterLink to="/bulletin/edit"><button type="button" class="btn btn-secondary">發布公告</button>
						</RouterLink>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="accordion" id="bulletin">
					<div v-for="info in cut">
						<div class="accordion-item">
							<div class="accordion-header" v-bind:id="info.headid">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
									v-bind:data-bs-target="info.actbody" aria-expanded="true"
									v-bind:aria-controls="info.bodyid">
									<strong>{{ info.title }}</strong>
								</button>
								<div class="row">
									<div class="col-md-2">
										<div class="text-secondary">
											&nbsp;&nbsp;&nbsp;
											{{ info.name }}
										</div>
									</div>
									<div class="col-md-3">
										<div class="text-secondary">
											發布者：{{ info.sender }}
										</div>
									</div>
									<div class="col-md-2">
										<div class="text-secondary">
											對象：{{ info.receiver }}
										</div>
									</div>
									<div class="col-md-3">
										<div class="text-secondary">
											{{ info.time }}
										</div>
									</div>
									<div class="col-md-2 edit_icon">
										<button v-if="userName == 'administrator'" class="del_button"
											@click="del_bulletin"><img src="../assets/trash.png" width="20"></button>
									</div>
								</div>
							</div>
							<div v-bind:id="info.bodyid" class="accordion-collapse collapse"
								v-bind:aria-labelledby="info.headid" data-bs-parent="#bulletin">
								<div class="accordion-body">
									{{ info.content }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-5">
				<ul class="pagination justify-content-center">
					<li class="page-item" v-for="n in this.totPage">
						<button class="page-link" @click="slice(n)">{{ n }}</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<RouterView />
</template>

<style>
.edit_icon {
	text-align: right;
	padding-right: 7%;
}

.del_button {
	background-color: transparent;
	border: none;
}
</style>