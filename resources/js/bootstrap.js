import axios from 'axios';
import snow from "./scripts/snow.js";
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

snow();
