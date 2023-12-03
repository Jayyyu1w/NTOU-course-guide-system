<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router';

const router = useRouter();
const userName = ref(null);
const authorization = ref(null);
const isSticky = ref(false);
const isFix = ref(false);
const el = ref < HTMLElement | null > (null);

userName.value = window.sessionStorage.getItem('userName');
authorization.value = window.sessionStorage.getItem('authorization');
window.addEventListener('scroll', () => {
	if (window.scrollY > 230) {
		isSticky.value = true;
		isFix.value = true;
	} else {
		isSticky.value = false;
		isFix.value = false;
	}
});

const logout = () => {
	window.sessionStorage.removeItem('userName')
	window.sessionStorage.removeItem('authorization')
	userName.value = null
	router.push('/')
};
</script>

<template>
	<section id="banner">
		<div class="masthead">
			<div class="container">
				<div class="row h-100 align-items-center">
				</div>
			</div>
		</div>
	</section>
	<div ref="el" :class="{ 'barStick': isSticky }">
		<section id="header">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
				<div class="container mt-1 mb-1">
					<RouterLink class="navbar-brand header_font" to="/">資工課程導覽</RouterLink>
					<a class="navbar-brand" href="https://www.ntou.edu.tw/" target="_blank">
						<img src="@/assets/ntou.png" width="150" height="30" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
						aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
						<ul class="navbar-nav ms-auto">
							<li class="nav-item">
								<RouterLink class="nav-link active" aria-current="page" to="/">首頁</RouterLink>
							</li>
							<li class="nav-item">
								<RouterLink class="nav-link" to="/course/list">所有課程</RouterLink>
							</li>
							<li class="nav-item">
								<RouterLink class="nav-link" to="/bulletin/main">所有公告</RouterLink>
							</li>
							<li class="nav-item">
								<div v-if="userName != null">
									<a v-if="authorization == 1" class="nav-link"
										href="https://database--project.000webhostapp.com/get_log_2.php">
										({{ userName }})
									</a>
									<a v-else class="nav-link" href="#">({{ userName }})</a>
								</div>
								<div v-else>
									<RouterLink class="nav-link" to="/login">登入</RouterLink>
								</div>
							</li>
							<div v-if="userName != null">
								<li class="nav-item">
									<a class="nav-link" href="#" @click="logout">登出</a>
								</li>
							</div>
						</ul>
					</div>
				</div>
			</nav>
		</section>
	</div>
	<div ref="el" :class="{ 'FixPos': isFix }"></div>
</template>

<style>
#banner .masthead {
	height: 20vh;
	min-height: 230px;
	background-image: url('@/assets/banner.png');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
}

.header_font {
	font-weight: bold;
	font-size: 28px
}

.barStick {
	position: fixed;
	top: 0;
	width: 100%;
	z-index: 999;
}

.FixPos {
	height: 76px;
}
</style>