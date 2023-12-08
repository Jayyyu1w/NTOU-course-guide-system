<script setup lang="ts">
import { RouterLink } from 'vue-router'
import Calendar from '@/components/calendar.vue'
import IndexBulletin from '@/components/index_bulletin.vue'
import IndexHot from '@/components/index_hot.vue'
</script>

<template>
    <section id="content">
		<div class="container my-5">
			<div class="row">
				<div class="row">
					<div class="col-md-8">
						<div class="container row-md-6">
							<div class="title_decoration row h-100 px-4 mb-4">
								最新公告
							</div>
							<IndexBulletin />
							<div id="notification">
								<RouterLink to="/bulletin/main" class="more">>&nbsp;更多...</RouterLink>
							</div>
						</div>
						<div class="container row-md-6 my-5">
							<div class="title_decoration row h-100 px-4 mb-4">
								重要時程
							</div>
							<Calendar />
						</div>
					</div>
					<div class="col-md-4">
						<div class="container">
							<div class="title_decoration row h-100 px-4 mb-4">
								熱門課程
							</div>
							<IndexHot />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<style scoped>
#navi {
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	z-index: 100;
}

.title_decoration {
	background: linear-gradient(to right, #233559 0, #233559 10px, #F0F0F0 10px, #F0F0F0 100%);
	color: black;
	font-size: 28px;
	font-weight: bold;
}

.more {
	text-decoration: none;
	color: navy;
	float: right;
}
</style>