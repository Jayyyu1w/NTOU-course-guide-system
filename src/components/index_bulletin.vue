<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';

const bulletin_info = ref([]);
const pageSize = ref(5);
const curPage = ref(1);
const cut = ref([]);

onMounted(() => {
	axios.get("https://database--project.000webhostapp.com/bulletin.php")
		.then((res) => {
			bulletin_info.value = res.data;
			for (let item of bulletin_info.value) {
				item.headid = "head" + item.bulletin_ID;
				item.bodyid = "body" + item.bulletin_ID;
				item.actbody = "#" + item.bodyid;
			}
			cut.value = bulletin_info.value.slice((curPage.value * pageSize.value) - pageSize.value, (curPage.value * pageSize.value))
		})
});
</script>

<template>
	<div class="container">
		<div class="row">
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
								<div class="col-md-3">
									<div class="text-secondary">
										&nbsp;&nbsp;&nbsp;
										{{ info.name }}
									</div>
								</div>
								<div class="col-md-2">
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
	</div>
</template>

<style></style>