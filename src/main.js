import { createApp } from 'vue';
import { createPinia } from 'pinia';
import jquery from 'jquery';
import App from './App.vue';
import router from './router';
import { useWindowSize } from '@vueuse/core';

const { width, height } = useWindowSize()
const app = createApp(App)

Vue.prototype.$width = width
Vue.prototype.$height = height
app.use(jquery)
app.use(createPinia())
app.use(router)


app.mount('#app')
