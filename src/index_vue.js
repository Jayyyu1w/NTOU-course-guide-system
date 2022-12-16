import { createApp } from 'vue'
import App from '/components/index_notify.vue'
import App1 from '/components/index_calender.vue'
import App2 from '/components/index_popular.vue'

createApp(App).mount("#notification");
createApp(App1).mount("#calender");
createApp(App2).mount("#popular");