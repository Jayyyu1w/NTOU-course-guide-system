<script setup>
import indexheader from '../components/index_head.vue'
import calendar from '../components/calendar.vue'
import indexbulletin from '../components/index_bulletin.vue'
import indexhot from '../components/index_hot.vue'
</script>

<template>
	<div>
		<indexheader></indexheader>
	</div>
	<div id="head"></div>
	<div id="fixpos"></div>
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
										<indexbulletin></indexbulletin>
										<div id="notification">
											<a href="bulletin/bulletin.html" class="more">>&nbsp;更多...</a>
										</div>
									</div>
									<div class="container row-md-6 my-5">
										<div class="title_decoration row h-100 px-4 mb-4">
											重要時程
										</div>
										<calendar></calendar>
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
								<indexhot></indexhot>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
