import { createApp } from 'vue'
import App1 from '/components/index_calender.vue'
import App2 from '/components/index_head.vue'
import App3 from '/components/index_bulletin.vue'
import App4 from '/components/index_hot.vue'

createApp(App1).mount("#calender");
createApp(App2).mount("#head");
createApp(App3).mount("#bulletin");
createApp(App4).mount("#hot");