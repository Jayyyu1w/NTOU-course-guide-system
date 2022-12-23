import { createApp } from 'vue'
import MdEditorV3 from 'md-editor-v3'
import App from '../components/course_md_edit.vue'
import App2 from '../components/head.vue'

createApp(App).use(MdEditorV3).mount("#md_editor");
createApp(App2).mount("#head");
