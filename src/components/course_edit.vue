<script setup lang="ts">
import { ref, onMounted, onSave } from 'vue';
import axios from 'axios';
import MdEditor from 'md-editor-v3'
import 'md-editor-v3/lib/style.css'
import '@vavt/md-editor-extension/dist/previewTheme/arknights.css';
import ZH_TW from '@vavt/md-editor-extension/dist/locale/zh-TW';

MdEditor.config({
  editorConfig: {
    languageUserDefined: {
      'zh-TW': ZH_TW,
    },
  },
});

const text = ref('')
const toolbarsExclude = ['image', 'htmlPreview', 'github']

onMounted(() => {
  let getUrlString = location.href;
  let url = new URL(getUrlString);
  this.class_ID = url.searchParams.get('course_ID');
  this.class = url.searchParams.get('class');
  let links = "https://database--project.000webhostapp.com/get_information.php?course_ID=" + this.class_ID + "&class=" + this.class;
  axios.get(links).then((res) => {
    let ret = res.data;
    console.log(ret);
    this.text = ret[0].information;
  });
})

onSave(() => {
  console.log(this.text);
  let postData = { "text": this.text };
  let postd = JSON.stringify(postData);
  console.log(postd);
  let links = "https://database--project.000webhostapp.com/course_md_edit.php?course_ID=" + this.class_ID + "&class=" + this.class;
  axios.post(links, postd).then((res) => {
    console.log(res);
  });
})
</script>

<template>
  <div id="md-editor" class="container">
    <md-editor language="zh-TW" v-model="text" @onSave="onSave" :toolbarsExclude="toolbarsExclude" maxLength=5000 />
  </div>
</template>

<style>
#md-editor {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 50px;
}
</style>
