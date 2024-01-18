import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router.js';
import axios from 'axios';

const app = createApp(App);

app.use(router);

app.provide('axios', axios);

app.mount('#app');