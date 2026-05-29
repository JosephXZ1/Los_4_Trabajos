import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'

// Configuración global de la URL de Laravel
window.axios = axios
window.axios.defaults.baseURL = 'http://127.0.0.1:8000'

createApp(App).mount('#app')