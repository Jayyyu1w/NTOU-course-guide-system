<script setup lang="ts">
import { RouterLink } from 'vue-router'
import Calendar from '@/components/calendar.vue'
import IndexBulletin from '@/components/index_bulletin.vue'
import IndexHot from '@/components/index_hot.vue'
</script>

<template>
  <el-container class="my-5">
    <el-main>
      <el-row>
        <el-col :span="11" :offset="3">
          <div style="margin-bottom: 3.5rem;">
            <div class="title_decoration">最新消息</div>
            <IndexBulletin />
            <div id="notification">
              <RouterLink to="/bulletin/main" class="more">>&nbsp;更多...</RouterLink>
            </div>
          </div>
          <div class="title_decoration">重要時程</div>
          <Calendar />
        </el-col>
        <el-col :span="6" :offset="1">
          <div class="title_decoration">熱門課程</div>
          <IndexHot />
        </el-col>
      </el-row>
    </el-main>
  </el-container>
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
  background: linear-gradient(to right, #233559 0, #233559 10px, #f0f0f0 10px, #f0f0f0 100%);
  color: black;
  font-size: 28px;
  font-weight: bold;
  padding-left: 1.5rem;
	margin-bottom: 1.5rem;
}

.more {
  text-decoration: none;
  color: navy;
  float: right;
	margin-top: 0.5rem;
}
</style>
