<script>
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

export default {
  name: 'App',
  components: {
    MdEditor
  },
  data() {
    return {
      text: '',
      toobars: ['bold', 'underline', 'italic', 'strikeThrough',
        'sub', 'sup', 'quote', 'unorderedList', 'orderedList', 'codeRow',
        'code', 'link', 'image', 'table', 'revoke',
        'next', 'save', 'pageFullscreen', 'fullscreen',
        'preview', 'htmlPreview', 'github'],
      toolbarsExclude: ['image', 'htmlPreview', 'github'],
    }
  },
  created: function () {
    let getUrlString = location.href;
    let url = new URL(getUrlString);
    this.class_ID = url.searchParams.get('course_ID');
    this.class = url.searchParams.get('class');
    let links = "https://database--project.000webhostapp.com/get_information.php?course_ID=" + this.class_ID + "&class=" + this.class;
    axios.get(links).then((res) => {
      let ret = res.data;
      console.log(ret);
      this.text = ret.information;
    });
  },
  methods: {
    onSave: function (v, h) {
      console.log(v);
      let postData = { "text": v };
      let postd = JSON.stringify(postData);
      console.log(postd);
      axios.post('https://database--project.000webhostapp.com/course_md_edit.php', postd).then((res) => {
        console.log(res);
        h.then((html) => {
          console.log(html);
        })
      });
    },
    mounted: function () {
    },
  }
}
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
