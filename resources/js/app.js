// Import Bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Import Axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
