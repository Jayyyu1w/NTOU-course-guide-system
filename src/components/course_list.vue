<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { Search } from '@element-plus/icons-vue'

interface Course {
  course_ID: string
  name: string
  semester: string
  grade: number
  class: string
  credit: number
  teacher: string
  dept: string
}

const router = useRouter()

const course_info = ref<Course[]>([])
const grade_1 = ref<Course[]>([])
const grade_2 = ref<Course[]>([])
const grade_3 = ref<Course[]>([])
const grade_4 = ref<Course[]>([])
const display_course = ref<Course[]>([])
const no_course = ref(false)
const keyword = ref('')
const semester = ref('all')

const searching = () => {
  display_course.value = []
  for (let item of course_info.value) {
    if (keyword.value == '') {
      continue
    } else if (item.name.search(keyword.value) != -1) {
      display_course.value.push(item)
    }
  }
  console.log(display_course)
}

const changeWeb = (dis: { course_ID: string; class: any }) => {
  router.push({
    path: '/course/info/' + dis.course_ID,
    query: { course_ID: dis.course_ID, class: dis.class }
  })
}

const changeDisplayCourse = () => {
  if (semester.value == 'freshman') {
    display_course.value = grade_1.value
  } else if (semester.value == 'sophmore') {
    display_course.value = grade_2.value
  } else if (semester.value == 'junior') {
    display_course.value = grade_3.value
  } else if (semester.value == 'senior') {
    display_course.value = grade_4.value
  } else {
    display_course.value = course_info.value
  }
}

axios.get('https://database--project.000webhostapp.com/course.php').then((res) => {
  course_info.value = res.data
  console.log('course_info', course_info.value)
  for (let item of course_info.value) {
    if (item.grade == 1) grade_1.value.push(item)
    else if (item.grade == 2) grade_2.value.push(item)
    else if (item.grade == 3) grade_3.value.push(item)
    else if (item.grade == 4) grade_4.value.push(item)
  }
  display_course.value = course_info.value
  console.log('grade_1', grade_1.value)
  console.log('grade_2', grade_2.value)
  console.log('grade_3', grade_3.value)
  console.log('grade_4', grade_4.value)
})
</script>

<template>
  <el-container style="margin-top: 2%; margin-bottom: 2%" id="courses">
    <el-col :offset="3" :span="18">
      <div style="text-align: center; font-weight: bold; font-size: 28px">所有課程</div>
      <el-col :span="20" style="margin-top: 1.5%">
        <el-input placeholder="keyword" class="input-with-select" v-model="keyword">
          <template #append>
            <el-button :icon="Search" />
          </template>
        </el-input>
        <el-radio-group v-model="semester" @change="changeDisplayCourse" class="flex">
          <el-radio label="freshman" size="large">大一</el-radio>
          <el-radio label="sophmore" size="large">大二</el-radio>
          <el-radio label="junior" size="large">大三</el-radio>
          <el-radio label="senior" size="large">大四</el-radio>
          <el-radio label="all" size="large">全部</el-radio>
        </el-radio-group>
      </el-col>
      <div class="mt-3">
        <div v-if="display_course.length == 0">
          <h3 style="text-align: center; font-weight: bold">查無課程</h3>
        </div>
        <div v-else>
          <div v-for="dis in display_course" :key="dis.course_ID">
            <el-card @click="changeWeb(dis)" shadow="never">
              <h1>{{ dis.name }}</h1>
              <h3>學期：{{ dis.semester }}</h3>
              <div>課號：{{ dis.course_ID }}</div>
              <div>
                資訊工程學系&nbsp;&nbsp;&nbsp;{{ dis.grade }}&nbsp;&nbsp;&nbsp;{{ dis.class }}
              </div>
              <div>
                學分數：{{ dis.credit }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 授課教師：{{
                  dis.teacher
                }}
              </div>
            </el-card>
          </div>
        </div>
      </div>
    </el-col>
  </el-container>
</template>

<style scoped>
#course_list li {
  height: auto;
}

.filter {
  border-style: initial;
  border-width: thick;
}

.title {
  font-size: 32px;
  text-align: center;
  font-weight: bold;
  margin-bottom: 3%;
}
</style>
