<script setup>
import navbar from '../components/head.vue'
import calendar from '../components/calendar.vue'
import indexbulletin from '../components/index_bulletin.vue'
import indexhot from '../components/index_hot.vue'
</script>

<template>
	<navbar />
	<section id="content">
		<div class="container my-5">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8">
							<div class="col">
								<div class="row-md-12">
									<div class="container row-md-6">
										<div class="title_decoration row h-100 px-4 mb-4">
											最新公告
										</div>
										<indexbulletin />
										<div id="notification">
											<a href="bulletin/bulletin.html" class="more">>&nbsp;更多...</a>
										</div>
									</div>
									<div class="container row-md-6 my-5">
										<div class="title_decoration row h-100 px-4 mb-4">
											重要時程
										</div>
										<calendar />
									</div>
								</div>
							</div>
							<!---->
						</div>
						<div class="col-md-4">
							<div class="container">
								<div class="title_decoration row h-100 px-4 mb-4">
									熱門課程
								</div>
								<indexhot />
							</div>
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
</style>