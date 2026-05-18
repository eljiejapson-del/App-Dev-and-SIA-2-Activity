import axios from 'axios';
window.axios = axios;

// This header is required for Laravel to recognize AJAX requests
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';