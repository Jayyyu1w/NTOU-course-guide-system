import { createApp } from 'vue'
import MdEditorV3 from 'md-editor-v3'
import App from '../components/course_info.vue'
import App2 from '../components/course_info_messageboard.vue'
import App3 from '../components/head.vue'
import App4 from '../components/course_info_messageadd.vue'

createApp(App).use(MdEditorV3).mount("#class_info");
createApp(App2).mount("#message");
createApp(App3).mount("#head");
createApp(App4).mount("#message_add");