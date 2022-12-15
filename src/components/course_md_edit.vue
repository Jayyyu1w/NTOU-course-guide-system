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
      text: 'Hello md-editor-v3！',
      toobars: ['bold', 'underline', 'italic', 'strikeThrough',
        'sub', 'sup', 'quote', 'unorderedList', 'orderedList', 'codeRow',
        'code', 'link', 'image', 'table', 'revoke',
        'next', 'save', 'pageFullscreen', 'fullscreen',
        'preview', 'htmlPreview', 'github'],
      toolbarsExclude: ['image', 'htmlPreview', 'github'],
    }
  },
  methods: {
    onSave: function (v, h) {
      console.log(v);
      h.then((html) => {
        console.log(html);
      });
    },
    onUploadImg: function (files, callback) {
      console.log(`img upload success! ${files}`);
    }
    /*const onUploadImg = async (files, callback) => {
      const res = await Promise.all(
        files.map((file) => {
          return new Promise((rev, rej) => {
            const form = new FormData();
            form.append('file', file);

            axios
              .post('/api/img/upload', form, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
              })
              .then((res) => rev(res))
              .catch((error) => rej(error));
          });
        })
      );

      callback(res.map((item) => item.data.url));
    };*/

  }
}
</script>

<template>
  <div id="md-editor" class="container">
    <md-editor language="zh-TW" v-model="text" @on-upload-image="onUploadImg" @onSave="onSave"
      :toolbarsExclude="toolbarsExclude" maxLength=5000 />
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
