import { createApp } from 'vue'
import MdEditorV3 from 'md-editor-v3'
import App from '../components/course_info.vue'

createApp(App).use(MdEditorV3).mount("#class_info");