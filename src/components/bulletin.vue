<script>
import axios from 'axios';

export default ({
	data: function () {
		return {
			bulletin_info: [],
			totBulletin: 0,
			pageSize: 10,
			curPage: 1,
			cut: [],
			totPage: 0,
			authorization: 0,
			bulletin_ID: 0,
			userName: window.sessionStorage.getItem('userName'),
		}
	},
	created: function () {
		//console.log(this.authorization);
		axios.get("https://database--project.000webhostapp.com/bulletin.php")
			.then((res) => {
				this.bulletin_info = res.data;
				this.bulletin_ID = this.bulletin_info[0].bulletin_ID;
				for (let item of this.bulletin_info) {
					item.headid = "head" + item.bulletin_ID;
					item.bodyid = "body" + item.bulletin_ID;
					item.actbody = "#" + item.bodyid;
					this.totBulletin += 1;
				}
				this.slice(1);
				this.totPage = Math.ceil(this.totBulletin / this.pageSize);
				console.log(this.totPage);
				this.authorization = window.sessionStorage.getItem('authorization');
				console.log(this.authorization);
			})
	},
	methods: {
		slice: function (cur) {
			window.scrollTo(0, 0);
			console.log(cur);
			this.curPage = cur;
			this.cut = this.bulletin_info.slice((this.curPage * this.pageSize) - this.pageSize, (this.curPage * this.pageSize))
		},
		del_bulletin: function () {
			console.log("delete");
			let ret = JSON.stringify({ "bulletin_ID": this.bulletin_ID });
			axios.post("https://database--project.000webhostapp.com/bulletin_delete.php", ret)
				.then((res) => {
					console.log(res.data);
					if (res.data == "success") {
						alert("刪除成功");
						this.$router.replace('/bulletin/main');
					}
					else {
						alert("刪除失敗");
					}
				})
		}
	},
	mounted: function () {

	}
});
</script>

<template>
	<div class="container mt-5">
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
									v-bind:data-bs-target="info.actbody" aria-expanded="true" v-bind:aria-controls="info.bodyid">
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
										<button v-if="userName == 'administrator'" class="del_button" @click="del_bulletin"><img
												src="../assets/trash.png" width="20"></button>
									</div>
								</div>
							</div>
							<div v-bind:id="info.bodyid" class="accordion-collapse collapse" v-bind:aria-labelledby="info.headid"
								data-bs-parent="#bulletin">
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