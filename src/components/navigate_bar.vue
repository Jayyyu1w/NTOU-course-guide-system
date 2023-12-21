<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const userName = ref<string | null>('')
const authorization = ref<number | null>(0)
const isSticky = ref(false)
const isFix = ref(false)
const el = ref<HTMLElement | null>(null)

userName.value = window.sessionStorage.getItem('userName')
authorization.value = window.sessionStorage.getItem('authorization')
window.addEventListener('scroll', () => {
  if (window.scrollY > 230) {
    isSticky.value = true
    isFix.value = true
  } else {
    isSticky.value = false
    isFix.value = false
  }
})

const logout = () => {
  window.sessionStorage.removeItem('userName')
  window.sessionStorage.removeItem('authorization')
  userName.value = null
  router.push('/')
}
</script>

<template>
  <section id="banner">
    <div class="masthead"></div>
  </section>
  <el-menu
    background-color="#222222"
    text-color="#FFFFFF"
    mode="horizontal"
    :ellipsis="false"
    ref="el"
    :class="{ barStick: isSticky }"
  >
    <el-menu-item index="0" id="ntou" style="margin-left: 12%">
      <RouterLink to="/">
        <el-link :underline="false">
          <div class="header_font">資工課程導覽</div>
        </el-link>
      </RouterLink>
    </el-menu-item>
    <el-menu-item index="1" id="ntou">
      <el-link :underline="false" href="https://www.ntou.edu.tw/" target="_blank">
        <img src="@/assets/ntou.png" width="165" height="35" alt="link to ntou" />
      </el-link>
    </el-menu-item>
    <div class="flex-grow" />
		<el-menu-item index="2">
			<RouterLink to="/course/list">
        <el-link :underline="false">
          <div class="navi_font">所有課程</div>
        </el-link>
      </RouterLink>
		</el-menu-item>
		<el-menu-item index="3">
			<RouterLink to="/bulletin/list">
        <el-link :underline="false">
          <div class="navi_font">所有公告</div>
        </el-link>
      </RouterLink>
		</el-menu-item>
    <el-sub-menu index="4" style="margin-right: 13%">
      <template #title><div class="navi_font">個人設定</div></template>
      <el-menu-item index="4-1">item one</el-menu-item>
      <el-menu-item index="4-2">item two</el-menu-item>
      <el-menu-item index="4-3">item three</el-menu-item>
      <el-sub-menu index="4-4">
        <template #title>item four</template>
        <el-menu-item index="4-4-1">item one</el-menu-item>
        <el-menu-item index="4-4-2">item two</el-menu-item>
        <el-menu-item index="4-4-3">item three</el-menu-item>
      </el-sub-menu>
    </el-sub-menu>
    <!-- <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
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
                <RouterLink class="nav-link" to="/bulletin/list">所有公告</RouterLink>
              </li>
              <li class="nav-item">
                <div v-if="userName != null">
                  <a
                    v-if="authorization == 1"
                    class="nav-link"
                    href="https://database--project.000webhostapp.com/get_log_2.php"
                  >
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
          </div> -->
  </el-menu>
  <div ref="el" :class="{ FixPos: isFix }"></div>
</template>

<style scoped>
.flex-grow {
  flex-grow: 1;
}

#banner .masthead {
  height: 20vh;
  min-height: 230px;
  background-image: url('@/assets/banner.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

#ntou:hover {
  background-color: transparent;
}

.header_font {
  font-weight: bold;
  font-size: 24px;
  color: white;
}

.navi_font {
	font-size: 18px;
	font-weight: bold;
}
.navi_font:hover {
	color: lightgray;
}

.barStick {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999;
}

.FixPos {
  height: 60px;
}
</style>
