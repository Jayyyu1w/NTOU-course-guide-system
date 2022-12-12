<script>
import MdEditor from 'md-editor-v3'
import 'md-editor-v3/lib/style.css'

export default {
  name: 'App',
  components: {
      MdEditor
  },
  data() {
      return {
          text: 'Hello md-editor-v3！'
      }
  },
  methods: {
      onUploadImg(files) {
          console.log('上傳圖片', files)
      }
  }
}
</script>

<template>
  <div id="md-editor">
      <md-editor v-model="text" @onUploadImg="onUploadImg" />
  </div>
</template>

<style>
#md-editor {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 100px;
}
</style>
