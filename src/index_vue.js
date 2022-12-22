import { createApp } from 'vue'
import App1 from '/components/index_calender.vue'
import App2 from '/components/index_popular.vue'
import App3 from '/components/index_bulletin.vue'

createApp(App1).mount("#calender");
createApp(App2).mount("#popular");
createApp(App3).mount("#bulletin");