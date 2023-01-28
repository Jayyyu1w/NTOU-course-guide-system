import { createApp } from 'vue';
import { createPinia } from 'pinia';
import jquery from 'jquery';
import App from './App.vue';
import router from './router';

const app = createApp(App)

app.use(jquery)
app.use(createPinia())
app.use(router)


app.mount('#app')
