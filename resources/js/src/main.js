import './assets/main.css'
import { createApp } from 'vue'
import axios  from 'axios'
import App from './App.vue'
import router from './router'
import {createPinia} from 'pinia'
import VueCookies from 'vue-cookies'

const app = createApp(App)
const pinia = createPinia()
axios.defaults.withCredentials = true;


app.use(router)
app.use(pinia)
app.mount('#app')

// app.use(VueCookies)