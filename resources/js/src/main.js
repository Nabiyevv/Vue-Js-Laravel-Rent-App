import './assets/main.css'
import { createApp } from 'vue'
import axios  from 'axios'
import App from './App.vue'
import {createPinia} from 'pinia'
import router from './router'
import VueCookies from 'vue-cookies'
import {useUserStore} from './store/user'

const app = createApp(App)
const pinia = createPinia()
app.use(pinia)
app.use(router)


const userStore = useUserStore();
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000';

axios.defaults.headers.common['Authorization'] = `Bearer ${userStore.token}`;
axios.defaults.headers.common['Accept'] = `application/json`;
axios.defaults.headers.common['Content-Type'] = `application/json`;


app.mount('#app')

// app.use(VueCookies)